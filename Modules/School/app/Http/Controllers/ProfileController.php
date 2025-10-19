<?php

namespace Modules\School\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\School\App\Models\School;
use Modules\School\App\Models\SchoolProfile;

class ProfileController extends Controller
{
    public function edit()
    {
        $school = School::with('profile')->first();

        if (!$school) {
            return redirect('/dashboard')->with('error', 'Data sekolah belum tersedia.');
        }

        return view('school::profile.edit', compact('school'));
    }

    public function update(Request $request)
    {
        $request->validate([
            // Data School
            'nama_sekolah' => 'required|string|max:255',
            'npsn' => 'nullable|digits:8',
            'nss' => 'nullable|string|max:12',
            'jenjang' => 'required|in:TK,RA,SD,MI,Diniyah,SMP,MTs,SMA,MA,SMK',
            'status' => 'required|in:negeri,swasta',
            'akreditasi' => 'nullable|in:A,B,C,TT',
            'alamat_jalan' => 'nullable|string',
            'rt' => 'nullable|digits_between:1,3',
            'rw' => 'nullable|digits_between:1,3',
            'desa_kelurahan' => 'nullable|string',
            'kecamatan' => 'nullable|string',
            'kab_kota' => 'nullable|string',
            'provinsi' => 'nullable|string',
            'kode_pos' => 'nullable|digits:5',
            'telepon' => 'nullable|string|max:15',
            'email' => 'nullable|email',
            'website' => 'nullable|url',

            // Data SchoolProfile
            'tagline' => 'nullable|string|max:255',
            'about' => 'nullable|string',
            'primary_color' => 'required|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);

        $school = School::first();

        // Update School
        $school->update($request->only([
            'nama_sekolah', 'npsn', 'nss', 'jenjang', 'status', 'akreditasi',
            'alamat_jalan', 'rt', 'rw', 'desa_kelurahan', 'kecamatan',
            'kab_kota', 'provinsi', 'kode_pos', 'telepon', 'email', 'website'
        ]));

        // Update SchoolProfile
        $school->profile->update([
            'name' => $request->nama_sekolah,
            'tagline' => $request->tagline,
            'about' => $request->about,
            'primary_color' => $request->primary_color,
        ]);

        return redirect('/dashboard')->with('success', 'Profil sekolah berhasil diperbarui!');
    }
}
