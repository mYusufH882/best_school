<?php

namespace Modules\School\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\School\App\Models\School;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schools = School::latest()->paginate(10);
        return view('school::schools.index', compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('school::schools.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(School::rules());
        School::create($validated);

        return redirect()->route('schools.index')->with('success', 'Data sekolah berhasil disimpan');
    }

    /**
     * Show the specified resource.
     */
    public function show(School $school)
    {
        return view('school::show', compact('school'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(School $school)
    {
        return view('school::schools.edit', compact('school'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, School $school)
    {
        $rules = School::rules();
        $rules['npsn'] = 'required|digits:8|unique:schools,npsn,' . $school->id;

        $validated = $request->validate($rules);
        $school->update($validated);

        return redirect()->route('schools.index')
            ->with('success', 'Data sekolah berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(School $school)
    {
        $school->delete();
        return redirect()->route('schools.index')
            ->with('success', 'Data sekolah berhasil dihapus');
    }
}
