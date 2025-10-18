<?php

namespace Modules\School\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\School\App\Models\SchoolProfile;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('school::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('school::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('school::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $profile = SchoolProfile::first();
        return view('school::profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'about' => 'nullable|string',
            'primary_color' => 'required|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);

        $profile = SchoolProfile::first();
        $profile->update($request->only(['name', 'tagline', 'about', 'primary_color']));

        return redirect('/dashboard')->with('success', 'Profil sekolah berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
