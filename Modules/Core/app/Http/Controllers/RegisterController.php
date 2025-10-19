<?php

namespace Modules\Core\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\School;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function show()
    {
        return view('core::register');
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'school_name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required|string|min:8',
    //     ]);

    //     try {
    //         $centralDomain = config('tenancy.central_domains')[1] ?? 'best_school.test';
    //         $slug = Str::slug($request->school_name, '_');
    //         $domainSlug = str_replace('_', '-', $slug);
    //         $fullDomain = "{$domainSlug}.{$centralDomain}";

    //         if (Domain::where('domain', $fullDomain)->exists()) {
    //             return back()->withErrors(['school_name' => 'Nama sekolah sudah digunakan.'])->withInput();
    //         }

    //         // Simpan data sementara di cache (10 menit cukup)
    //         $cacheKey = "tenant_registration_{$slug}";
    //         Cache::store('redis')->put($cacheKey, [
    //             'email' => $request->email,
    //             'password' => bcrypt($request->password),
    //             'school_name' => $request->school_name,
    //         ], now()->addMinutes(10));

    //         // Buat tenant → ini akan picu event TenantCreated → migrasi → DatabaseMigrated
    //         $tenant = Tenant::create([
    //             'id' => $slug,
    //             'school_name' => $request->school_name,
    //             'email' => $request->email,
    //             'domain' => $fullDomain,
    //         ]);

    //         $tenant->domains()->create(['domain' => $fullDomain]);

    //         $protocol = app()->environment('local') ? 'http' : 'https';
    //         return redirect()->away("{$protocol}://{$fullDomain}/welcome")
    //             ->with('success', 'Sekolah berhasil didaftarkan!');

    //     } catch (\Exception $e) {
    //         Log::error('Registration failed: ' . $e->getMessage());
    //         return back()->withErrors(['error' => 'Pendaftaran gagal.'])->withInput();
    //     }
    // }

    public function store(Request $request)
    {
        $request->validate([
            'school_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $tenant = null;
        $databaseName = null;

        try {
            $centralDomain = config('tenancy.central_domains')[1] ?? 'best_school.test';
            $slug = Str::slug($request->school_name, '_');
            $domainSlug = str_replace('_', '-', $slug);
            $fullDomain = "{$domainSlug}.{$centralDomain}";

            if (Domain::where('domain', $fullDomain)->exists()) {
                return back()->withErrors(['school_name' => 'Nama sekolah sudah digunakan.'])->withInput();
            }

            // PENTING: Drop database lama jika ada
            $databaseName = config('tenancy.database.prefix') . $slug . config('tenancy.database.suffix');

            try {
                DB::statement("DROP DATABASE IF EXISTS {$databaseName}");
                Log::info("Dropped existing database: {$databaseName}");
            } catch (\Exception $e) {
                Log::info("No existing database to drop");
            }

            $tenant = Tenant::create([
                'id' => $slug,
                'school_name' => $request->school_name,
                'email' => $request->email,
                'domain' => $fullDomain,
            ]);
            $tenant->domains()->create(['domain' => $fullDomain]);

            DB::statement("CREATE DATABASE {$databaseName} ENCODING 'UTF8'");
            sleep(1);

            $dbConfig = config("database.connections.pgsql");
            $dbConfig['database'] = $databaseName;
            config(["database.connections.tenant_temp" => $dbConfig]);
            DB::purge('tenant_temp');

            DB::connection('tenant_temp')->statement("
                CREATE TABLE migrations (
                    id SERIAL PRIMARY KEY,
                    migration VARCHAR(255) NOT NULL,
                    batch INT NOT NULL
                )
            ");

            $migrator = app('migrator');
            $migrator->setConnection('tenant_temp');

            $paths = [
                database_path('migrations/tenant'),
                base_path('Modules/School/database/migrations/tenants'),
            ];

            foreach ($paths as $path) {
                if (is_dir($path)) {
                    $migrator->run($path);
                }
            }

            School::on('pgsql')->create([
                'tenant_id' => $tenant->id,
                'name' => $request->school_name,
                'email' => $request->email,
                'domain' => $fullDomain,
                'database_name' => $databaseName,
                'status' => 'active',
            ]);

            Log::info("✅ School record created in central DB");

            $tenant->run(function () use ($request) {
                \Modules\School\App\Models\User::create([
                    'name' => 'Admin',
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                ]);

                \Modules\School\App\Models\SchoolProfile::create([
                    'name' => $request->school_name,
                    'tagline' => 'Sekolah Unggulan di Kota Kami',
                    'about' => 'Kami berkomitmen pada pendidikan berkualitas.',
                    'primary_color' => '#3b82f6',
                ]);
            });

            $protocol = app()->environment('local') ? 'http' : 'https';
            return redirect()->away("{$protocol}://{$fullDomain}/welcome")
                ->with('success', 'Sekolah berhasil didaftarkan!');

        } catch (\Exception $e) {
            Log::error('Registration failed: ' . $e->getMessage());

            if ($tenant) $tenant->delete();
            if ($databaseName) {
                try {
                    DB::purge('tenant_temp');
                    DB::statement("DROP DATABASE IF EXISTS {$databaseName}");
                } catch (\Exception $ex) {}
            }

            return back()->withErrors(['error' => 'Pendaftaran gagal.'])->withInput();
        }
    }
}
