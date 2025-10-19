<?php

namespace Modules\School\App\Services;

use Modules\School\App\Models\Student;
use Modules\School\App\Models\Teacher;

class DapodikValidator
{
    /**
     * Validasi format data siswa sesuai Dapodik
     */
    public function validateStudent(array $data): array
    {
        $errors = [];

        // Validasi NISN (10 digit)
        if (!isset($data['nisn']) || !preg_match('/^\d{10}$/', $data['nisn'])) {
            $errors[] = 'NISN harus 10 digit angka';
        } else {
            // Cek duplikasi NISN
            if (Student::where('nisn', $data['nisn'])->exists()) {
                $errors[] = "NISN {$data['nisn']} sudah terdaftar";
            }
        }

        // Validasi NIK (16 digit)
        if (!isset($data['nik']) || !preg_match('/^\d{16}$/', $data['nik'])) {
            $errors[] = 'NIK harus 16 digit angka';
        } else {
            // Cek duplikasi NIK
            if (Student::where('nik', $data['nik'])->exists()) {
                $errors[] = "NIK {$data['nik']} sudah terdaftar";
            }
        }

        // Validasi Jenis Kelamin
        if (!isset($data['jenis_kelamin']) || !in_array($data['jenis_kelamin'], ['L', 'P'])) {
            $errors[] = 'Jenis kelamin harus L atau P';
        }

        // Validasi Tanggal Lahir
        if (isset($data['tanggal_lahir'])) {
            $date = \DateTime::createFromFormat('Y-m-d', $data['tanggal_lahir']);
            if (!$date || $date->format('Y-m-d') !== $data['tanggal_lahir']) {
                $errors[] = 'Format tanggal lahir tidak valid (gunakan Y-m-d)';
            }
        } else {
            $errors[] = 'Tanggal lahir wajib diisi';
        }

        return [
            'valid' => empty($errors),
            'errors' => $errors
        ];
    }

    /**
     * Validasi format data guru sesuai Dapodik
     */
    public function validateTeacher(array $data): array
    {
        $errors = [];

        // Validasi NIK (16 digit)
        if (!isset($data['nik']) || !preg_match('/^\d{16}$/', $data['nik'])) {
            $errors[] = 'NIK harus 16 digit angka';
        } else {
            if (Teacher::where('nik', $data['nik'])->exists()) {
                $errors[] = "NIK {$data['nik']} sudah terdaftar";
            }
        }

        // Validasi NUPTK (16 digit, opsional)
        if (isset($data['nuptk']) && !empty($data['nuptk'])) {
            if (!preg_match('/^\d{16}$/', $data['nuptk'])) {
                $errors[] = 'NUPTK harus 16 digit angka';
            } else {
                if (Teacher::where('nuptk', $data['nuptk'])->exists()) {
                    $errors[] = "NUPTK {$data['nuptk']} sudah terdaftar";
                }
            }
        }

        // Validasi NIP (18 digit untuk PNS, opsional)
        if (isset($data['nip']) && !empty($data['nip'])) {
            if (!preg_match('/^\d{18}$/', $data['nip'])) {
                $errors[] = 'NIP harus 18 digit angka';
            }
        }

        // Validasi Status Kepegawaian
        $validStatus = ['PNS', 'PPPK', 'GTY', 'GTT', 'Honorer'];
        if (!isset($data['status_kepegawaian']) || !in_array($data['status_kepegawaian'], $validStatus)) {
            $errors[] = 'Status kepegawaian tidak valid: ' . implode(', ', $validStatus);
        }

        return [
            'valid' => empty($errors),
            'errors' => $errors
        ];
    }
}
