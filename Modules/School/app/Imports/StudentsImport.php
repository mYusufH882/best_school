<?php

namespace Modules\School\App\Imports;

use Modules\School\App\Models\Student;
use Modules\School\App\Services\DapodikValidator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentsImport implements ToModel, WithHeadingRow, WithValidation
{
    protected $errors = [];

    public function model(array $row)
    {
        // Validasi Dapodik
        $validator = new DapodikValidator();
        $validation = $validator->validateStudent($row);

        if (!$validation['valid']) {
            $this->errors[] = [
                'row' => $row,
                'errors' => $validation['errors']
            ];
            return null;
        }

        return new Student([
            'nisn' => $row['nisn'],
            'nik' => $row['nik'],
            'nama_lengkap' => $row['nama_lengkap'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => $row['tanggal_lahir'],
            'agama' => $row['agama'],
            'alamat_jalan' => $row['alamat'] ?? null,
            'rt' => $row['rt'] ?? null,
            'rw' => $row['rw'] ?? null,
            'desa_kelurahan' => $row['desa_kelurahan'] ?? null,
            'kecamatan' => $row['kecamatan'] ?? null,
            'kab_kota' => $row['kab_kota'] ?? null,
            'provinsi' => $row['provinsi'] ?? null,
            'kode_pos' => $row['kode_pos'] ?? null,
            'status' => $row['status'] ?? 'aktif',
            'tanggal_masuk' => $row['tanggal_masuk'] ?? now(),
        ]);
    }

    public function rules(): array
    {
        return [
            'nisn' => 'required|digits:10',
            'nik' => 'required|digits:16',
            'nama_lengkap' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
        ];
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
