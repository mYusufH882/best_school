<?php

namespace Modules\School\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\School\App\Models\ParentGuardian;
use Modules\School\App\Models\School;
use Modules\School\App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Student::with('school')
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->search, fn($q) => $q->where('nama_lengkap', 'like', "%{$request->search}%")
                ->orWhere('nisn', 'like', "%{$request->search}%"))
            ->latest();

        $students = $query->paginate(20);

        return view('school::students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $schools = School::all();
        return view('school::students.create', compact('schools'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(Student::rules());

        DB::transaction(function () use ($validated, $request) {
            $student = Student::create($validated);

            // Simpan data orang tua jika ada
            if ($request->filled('parent_nik')) {
                $this->attachParent($student, $request);
            }
        });

        return redirect()->route('students.index')
            ->with('success', 'Data siswa berhasil disimpan');
    }

    /**
     * Show the specified resource.
     */
    public function show(Student $student)
    {
        $student->load(['school', 'parents', 'classes']);
        return view('school::students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $schools = School::all();
        $student->load('parents');
        return view('school::students.edit', compact('student', 'schools'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $rules = Student::rules();
        $rules['nisn'] = 'required|digits:10|unique:students,nisn,' . $student->id;
        $rules['nik'] = 'required|digits:16|unique:students,nik,' . $student->id;

        $validated = $request->validate($rules);

        DB::transaction(function () use ($validated, $student, $request) {
            $student->update($validated);

            if ($request->filled('parent_nik')) {
                $student->parents()->detach();
                $this->attachParent($student, $request);
            }
        });

        return redirect()->route('students.index')
            ->with('success', 'Data siswa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')
            ->with('success', 'Data siswa berhasil dihapus');
    }

    private function attachParent($student, $request)
    {
        // Cari atau buat parent
        $parent = ParentGuardian::firstOrCreate(
            ['nik' => $request->parent_nik],
            [
                'nama_lengkap' => $request->parent_nama,
                'no_hp' => $request->parent_hp,
                'pekerjaan' => $request->parent_pekerjaan,
                'alamat_jalan' => $request->alamat_jalan,
                'rt' => $request->rt,
                'rw' => $request->rw,
                'desa_kelurahan' => $request->desa_kelurahan,
                'kecamatan' => $request->kecamatan,
                'kab_kota' => $request->kab_kota,
                'provinsi' => $request->provinsi,
                'kode_pos' => $request->kode_pos,
            ]
        );

        $student->parents()->attach($parent->id, [
            'hubungan' => $request->parent_hubungan ?? 'ayah',
            'is_primary' => true
        ]);
    }
}
