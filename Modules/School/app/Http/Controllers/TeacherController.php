<?php

namespace Modules\School\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\School\App\Models\School;
use Modules\School\App\Models\Subject;
use Modules\School\App\Models\Teacher;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $query = Teacher::with(['school', 'subjects'])
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->search, fn($q) => $q->where('nama_lengkap', 'like', "%{$request->search}%")
                ->orWhere('nuptk', 'like', "%{$request->search}%")
                ->orWhere('nik', 'like', "%{$request->search}%"))
            ->latest();

        $teachers = $query->paginate(20);

        return view('school::teachers.index', compact('teachers'));
    }

    public function create()
    {
        $schools = School::all();
        $subjects = Subject::orderBy('nama_mapel')->get();
        return view('school::teachers.create', compact('schools', 'subjects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(Teacher::rules());

        DB::transaction(function () use ($validated, $request) {
            $teacher = Teacher::create($validated);

            if ($request->filled('subjects')) {
                $teacher->subjects()->attach($request->subjects);
            }
        });

        return redirect()->route('teachers.index')
            ->with('success', 'Data guru berhasil disimpan');
    }

    public function show(Teacher $teacher)
    {
        $teacher->load(['school', 'subjects', 'classesAsWali']);
        return view('school::teachers.show', compact('teacher'));
    }

    public function edit(Teacher $teacher)
    {
        $schools = School::all();
        $subjects = Subject::orderBy('nama_mapel')->get();
        $teacher->load('subjects');
        return view('school::teachers.edit', compact('teacher', 'schools', 'subjects'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $rules = Teacher::rules();
        $rules['nik'] = 'required|digits:16|unique:teachers,nik,' . $teacher->id;
        $rules['nuptk'] = 'nullable|digits:16|unique:teachers,nuptk,' . $teacher->id;

        $validated = $request->validate($rules);

        DB::transaction(function () use ($validated, $teacher, $request) {
            $teacher->update($validated);

            if ($request->filled('subjects')) {
                $teacher->subjects()->sync($request->subjects);
            }
        });

        return redirect()->route('teachers.index')
            ->with('success', 'Data guru berhasil diperbarui');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('teachers.index')
            ->with('success', 'Data guru berhasil dihapus');
    }
}
