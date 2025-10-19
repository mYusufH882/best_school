<?php

namespace Modules\School\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

// use Modules\School\Database\Factories\TeacherFactory;

class Teacher extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'school_id',
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
        'is_sertifikasi',
        'no_sertifikat_pendidik',
        'tahun_sertifikasi',
        'status',
        'tanggal_mulai_tugas',
        'tanggal_selesai_tugas',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_mulai_tugas' => 'date',
        'tanggal_selesai_tugas' => 'date',
        'is_sertifikasi' => 'boolean',
        'tahun_sertifikasi' => 'integer',
    ];

    public static function rules()
    {
        return [
            'nik' => 'required|digits:16|unique:teachers,nik',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'status_kepegawaian' => 'required|in:PNS,PPPK,GTY,GTT,Honorer',
            'nip' => 'nullable|digits:18',
        ];
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_teacher')
            ->withTimestamps();
    }

    public function classesAsWali()
    {
        return $this->hasMany(ClassRoom::class, 'wali_kelas_id');
    }

    public function classTeachings()
    {
        return $this->belongsToMany(ClassRoom::class, 'class_teacher')
            ->withPivot('subject_id', 'jam_per_minggu', 'tahun_ajaran', 'semester')
            ->withTimestamps();
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }

    public function scopeSertifikasi($query)
    {
        return $query->where('is_sertifikasi', true);
    }
}
