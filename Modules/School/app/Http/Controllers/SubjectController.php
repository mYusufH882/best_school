<?php

namespace Modules\School\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\School\App\Models\Subject;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Subject::query();

        // Filter by kelompok
        if ($request->filled('kelompok')) {
            $query->where('kelompok', $request->kelompok);
        }

        // Filter by jenjang
        if ($request->filled('jenjang')) {
            $query->whereJsonContains('jenjang', $request->jenjang);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_mapel', 'like', "%{$search}%")
                  ->orWhere('kode_mapel', 'like', "%{$search}%");
            });
        }

        $subjects = $query->orderBy('kelompok')->orderBy('nama_mapel')->paginate(20);

        return view('school::subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('school::subjects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_mapel' => 'required|string|max:10|unique:subjects,kode_mapel',
            'nama_mapel' => 'required|string|max:255',
            'kelompok' => 'required|in:A,B,C',
            'jenjang' => 'required|array|min:1',
            'jenjang.*' => 'in:TK,RA,SD,MI,Diniyah,SMP,MTs,SMA,MA,SMK',
        ]);

        Subject::create($validated);

        return redirect()->route('subjects.index')
            ->with('success', 'Mata pelajaran berhasil ditambahkan');
    }

    public function show(Subject $subject)
    {
        $subject->load('teachers');
        return view('school::subjects.show', compact('subject'));
    }

    public function edit(Subject $subject)
    {
        return view('school::subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'kode_mapel' => 'required|string|max:10|unique:subjects,kode_mapel,' . $subject->id,
            'nama_mapel' => 'required|string|max:255',
            'kelompok' => 'required|in:A,B,C',
            'jenjang' => 'required|array|min:1',
            'jenjang.*' => 'in:TK,RA,SD,MI,Diniyah,SMP,MTs,SMA,MA,SMK',
        ]);

        $subject->update($validated);

        return redirect()->route('subjects.index')
            ->with('success', 'Mata pelajaran berhasil diperbarui');
    }

    public function destroy(Subject $subject)
    {
        // Check if subject is assigned to teachers
        if ($subject->teachers()->count() > 0) {
            return redirect()->route('subjects.index')
                ->with('error', 'Mata pelajaran tidak dapat dihapus karena masih diampu oleh guru');
        }

        $subject->delete();

        return redirect()->route('subjects.index')
            ->with('success', 'Mata pelajaran berhasil dihapus');
    }
}
