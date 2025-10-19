<?php

namespace Modules\School\App\Exports;

use Modules\School\App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Student::with('school')->get();
    }

    public function headings(): array
    {
        return [
            'NISN',
            'NIK',
            'Nama Lengkap',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Agama',
            'Alamat',
            'RT',
            'RW',
            'Desa/Kelurahan',
            'Kecamatan',
            'Kab/Kota',
            'Provinsi',
            'Kode Pos',
            'Status',
            'Tanggal Masuk',
        ];
    }

    public function map($student): array
    {
        return [
            $student->nisn,
            $student->nik,
            $student->nama_lengkap,
            $student->jenis_kelamin,
            $student->tempat_lahir,
            $student->tanggal_lahir->format('Y-m-d'),
            $student->agama,
            $student->alamat_jalan,
            $student->rt,
            $student->rw,
            $student->desa_kelurahan,
            $student->kecamatan,
            $student->kab_kota,
            $student->provinsi,
            $student->kode_pos,
            $student->status,
            $student->tanggal_masuk->format('Y-m-d'),
        ];
    }
}
