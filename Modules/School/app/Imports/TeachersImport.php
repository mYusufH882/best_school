<?php

namespace Modules\School\App\Imports;

use Modules\School\App\Models\Teacher;
use Modules\School\App\Services\DapodikValidator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class TeachersImport implements ToModel, WithHeadingRow, WithValidation
{
    protected $errors = [];

    public function model(array $row)
    {
        // Validasi Dapodik
        $validator = new DapodikValidator();
        $validation = $validator->validateTeacher($row);

        if (!$validation['valid']) {
            $this->errors[] = [
                'row' => $row,
                'errors' => $validation['errors']
            ];
            return null;
        }

        return new Teacher([
            'nik' => $row['nik'],
            'nuptk' => $row['nuptk'] ?? null,
            'nip' => $row['nip'] ?? null,
            'nama_lengkap' => $row['nama_lengkap'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'tempat_lahir' => $row['tempat_lahir'] ?? null,
            'tanggal_lahir' => $row['tanggal_lahir'],
            'no_hp' => $row['no_hp'],
            'email' => $row['email'] ?? null,
            'status_kepegawaian' => $row['status_kepegawaian'],
            'pendidikan_terakhir' => $row['pendidikan_terakhir'] ?? 'S1',
            'jurusan_pendidikan' => $row['jurusan_pendidikan'] ?? null,
            'is_sertifikasi' => isset($row['sertifikasi']) && strtolower($row['sertifikasi']) == 'ya' ? true : false,
            'no_sertifikat_pendidik' => $row['no_sertifikat'] ?? null,
            'tahun_sertifikasi' => $row['tahun_sertifikasi'] ?? null,
            'status' => $row['status'] ?? 'aktif',
            'tanggal_mulai_tugas' => $row['tanggal_mulai_tugas'] ?? now(),
        ]);
    }

    public function rules(): array
    {
        return [
            'nik' => 'required|digits:16',
            'nama_lengkap' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'status_kepegawaian' => 'required|in:PNS,PPPK,GTY,GTT,Honorer',
        ];
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
