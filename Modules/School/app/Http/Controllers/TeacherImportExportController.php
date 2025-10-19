<?php

namespace Modules\School\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Modules\School\App\Exports\TeachersExport;
use Modules\School\App\Imports\TeachersImport;
use Modules\School\App\Models\Teacher;

class TeacherImportExportController extends Controller
{
    public function export()
    {
        // Cek apakah ada data guru
        if (Teacher::count() === 0) {
            return redirect()->route('teachers.index')
                ->with('warning', 'Tidak ada data guru untuk diekspor.');
        }

        return Excel::download(new TeachersExport, 'data-guru-' . date('Y-m-d') . '.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048'
        ]);

        $import = new TeachersImport();

        try {
            Excel::import($import, $request->file('file'));

            $errors = $import->getErrors();

            if (!empty($errors)) {
                return redirect()->route('teachers.index')
                    ->with('warning', 'Import selesai dengan ' . count($errors) . ' error')
                    ->with('import_errors', $errors);
            }

            return redirect()->route('teachers.index')
                ->with('success', 'Data guru berhasil diimport');

        } catch (\Exception $e) {
            return redirect()->route('teachers.index')
                ->with('error', 'Gagal import: ' . $e->getMessage());
        }
    }

    public function downloadTemplate()
    {
        $headers = [
            'nik',
            'nuptk',
            'nip',
            'nama_lengkap',
            'jenis_kelamin',
            'tempat_lahir',
            'tanggal_lahir',
            'no_hp',
            'email',
            'status_kepegawaian',
            'pendidikan_terakhir',
            'jurusan_pendidikan',
            'sertifikasi',
            'no_sertifikat',
            'tahun_sertifikasi',
            'status',
            'tanggal_mulai_tugas'
        ];

        $csvData = implode(',', $headers) . "\n";

        return response($csvData)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="template-guru.csv"');
    }
}
