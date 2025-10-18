<?php

namespace Modules\Core\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Modules\School\App\Models\SchoolProfile;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('core::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('core::create');
    }

    public function show()
    {
        return view('core::register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'school_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        try {
            $centralDomain = config('tenancy.central_domains')[1] ?? 'best_school.test';
            $slug = Str::slug($request->school_name, '_');
            $domainSlug = str_replace('_', '-', $slug);
            $fullDomain = "{$domainSlug}.{$centralDomain}";

            if (Domain::where('domain', $fullDomain)->exists()) {
                return back()->withErrors([
                    'school_name' => 'Nama sekolah sudah digunakan. Silakan pilih nama lain.'
                ])->withInput();
            }

            // HAPUS DB::beginTransaction() dan DB::commit()
            // Karena tenant->run() tidak support nested transaction

            $tenant = Tenant::create([
                'id' => $slug,
                'school_name' => $request->school_name,
                'email' => $request->email,
                'domain' => $fullDomain,
                'tenant_id' => $slug,
                'registered_at' => now()->toDateTimeString(),
                // 'plan' => 'basic',
                // 'status' => 'active',
            ]);

            $tenant->domains()->create(['domain' => $fullDomain]);

            // Tunggu database terbuat (dari event listener)
            sleep(2);

            $tenant->run(function () use ($request) {
                User::create([
                    'name' => 'Admin',
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                ]);

                SchoolProfile::create([
                    'name' => $request->school_name,
                    'tagline' => 'Sekolah Unggulan di Kota Kami',
                    'about' => 'Kami berkomitmen pada pendidikan berkualitas.',
                    'primary_color' => '#3b82f6',
                ]);
            });

            $protocol = app()->environment('local') ? 'http' : 'https';
            return redirect()->away("{$protocol}://{$fullDomain}/welcome")
                ->with('success', 'Sekolah berhasil didaftarkan!');

            // $protocol = app()->environment('local') ? 'http' : 'https';
            // return redirect()->away("{$protocol}://{$fullDomain}/welcome")
            //     ->with('success', 'Sekolah berhasil didaftarkan!');

        } catch (\Exception $e) {
            Log::error('Tenant registration failed: ' . $e->getMessage());

            if (isset($tenant)) {
                $tenant->delete();
            }

            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('core::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
