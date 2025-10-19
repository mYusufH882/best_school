<?php

namespace Modules\School\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

// use Modules\School\Database\Factories\StudentFactory;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'school_id',
        'nisn',
        'nik',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'alamat_jalan',
        'rt',
        'rw',
        'dusun',
        'desa_kelurahan',
        'kecamatan',
        'kab_kota',
        'provinsi',
        'kode_pos',
        'anak_ke',
        'jumlah_saudara_kandung',
        'status',
        'tanggal_masuk',
        'tanggal_keluar',
        'ppdb_registration_id',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_masuk' => 'date',
        'tanggal_keluar' => 'date',
    ];

    public static function rules()
    {
        return [
            'nisn' => 'required|digits:10|unique:students,nisn',
            'nik' => 'required|digits:16|unique:students,nik',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date|before:today',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
        ];
    }

    // Relasi
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function parents()
    {
        return $this->belongsToMany(ParentGuardian::class, 'student_parent')
            ->withPivot('hubungan', 'is_primary')
            ->withTimestamps();
    }

    public function classes()
    {
        return $this->belongsToMany(ClassRoom::class, 'class_student')
            ->withPivot('tahun_ajaran', 'semester', 'tanggal_masuk_kelas', 'tanggal_keluar_kelas', 'is_active')
            ->withTimestamps();
    }

    // Scope
    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }

    public function getUmurAttribute()
    {
        return $this->tanggal_lahir->age;
    }
}
