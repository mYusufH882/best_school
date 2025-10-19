<?php

namespace Modules\School\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Modules\School\App\Exports\StudentsExport;
use Modules\School\App\Imports\StudentsImport;

class StudentImportExportController extends Controller
{
    public function export()
    {
        return Excel::download(new StudentsExport, 'data-siswa-' . date('Y-m-d') . '.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048'
        ]);

        $import = new StudentsImport();

        try {
            Excel::import($import, $request->file('file'));

            $errors = $import->getErrors();

            if (!empty($errors)) {
                return redirect()->back()
                    ->with('warning', 'Import selesai dengan ' . count($errors) . ' error')
                    ->with('import_errors', $errors);
            }

            return redirect()->route('students.index')
                ->with('success', 'Data siswa berhasil diimport');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal import: ' . $e->getMessage());
        }
    }

    public function downloadTemplate()
    {
        $headers = [
            'nisn',
            'nik',
            'nama_lengkap',
            'jenis_kelamin',
            'tempat_lahir',
            'tanggal_lahir',
            'agama',
            'alamat',
            'rt',
            'rw',
            'desa_kelurahan',
            'kecamatan',
            'kab_kota',
            'provinsi',
            'kode_pos',
            'status',
            'tanggal_masuk'
        ];

        $csvData = implode(',', $headers) . "\n";

        return response($csvData)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="template-siswa.csv"');
    }
}
