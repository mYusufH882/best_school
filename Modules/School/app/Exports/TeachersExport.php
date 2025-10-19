<?php

namespace Modules\School\App\Exports;

use Modules\School\App\Models\Teacher;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TeachersExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Teacher::with('school')->get();
    }

    public function headings(): array
    {
        return [
            'NIK',
            'NUPTK',
            'NIP',
            'Nama Lengkap',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'No HP',
            'Email',
            'Status Kepegawaian',
            'Pendidikan Terakhir',
            'Jurusan Pendidikan',
            'Sertifikasi',
            'No Sertifikat',
            'Tahun Sertifikasi',
            'Status',
            'Tanggal Mulai Tugas',
        ];
    }

    public function map($teacher): array
    {
        return [
            $teacher->nik,
            $teacher->nuptk,
            $teacher->nip,
            $teacher->nama_lengkap,
            $teacher->jenis_kelamin,
            $teacher->tempat_lahir,
            $teacher->tanggal_lahir->format('Y-m-d'),
            $teacher->no_hp,
            $teacher->email,
            $teacher->status_kepegawaian,
            $teacher->pendidikan_terakhir,
            $teacher->jurusan_pendidikan,
            $teacher->is_sertifikasi ? 'Ya' : 'Tidak',
            $teacher->no_sertifikat_pendidik,
            $teacher->tahun_sertifikasi,
            $teacher->status,
            $teacher->tanggal_mulai_tugas->format('Y-m-d'),
        ];
    }
}
