<?php

namespace Modules\School\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\School\App\Models\ClassRoom;
use Modules\School\App\Models\School;
use Modules\School\App\Models\Teacher;

class ClassController extends Controller
{
    public function index(Request $request)
    {
        $query = ClassRoom::with(['school', 'waliKelas'])
            ->when($request->tahun_ajaran, fn($q) => $q->where('tahun_ajaran', $request->tahun_ajaran))
            ->when($request->tingkat, fn($q) => $q->where('tingkat', $request->tingkat))
            ->latest();

        $classes = $query->paginate(20);

        return view('school::classes.index', compact('classes'));
    }

    public function create()
    {
        $schools = School::all();
        $teachers = Teacher::active()->get();
        return view('school::classes.create', compact('schools', 'teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(ClassRoom::rules());
        ClassRoom::create($validated);

        return redirect()->route('classes.index')
            ->with('success', 'Data kelas berhasil disimpan');
    }

    public function show(ClassRoom $class)
    {
        $class->load(['school', 'waliKelas', 'activeStudents', 'teachers.subjects']);
        return view('school::classes.show', compact('class'));
    }

    public function edit(ClassRoom $class)
    {
        $schools = School::all();
        $teachers = Teacher::active()->get();
        return view('school::classes.edit', compact('class', 'schools', 'teachers'));
    }

    public function update(Request $request, ClassRoom $class)
    {
        $validated = $request->validate(ClassRoom::rules());
        $class->update($validated);

        return redirect()->route('classes.index')
            ->with('success', 'Data kelas berhasil diperbarui');
    }

    public function destroy(ClassRoom $class)
    {
        $class->delete();
        return redirect()->route('classes.index')
            ->with('success', 'Data kelas berhasil dihapus');
    }
}
