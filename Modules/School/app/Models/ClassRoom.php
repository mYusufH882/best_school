<?php

namespace Modules\School\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

// use Modules\School\Database\Factories\ClassRoomFactory;

class ClassRoom extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'classes';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'school_id',
        'nama_kelas',
        'tingkat',
        'jurusan',
        'rombel',
        'tahun_ajaran',
        'semester',
        'kapasitas_maksimal',
        'jumlah_siswa_saat_ini',
        'wali_kelas_id',
        'ruang_kelas',
        'status',
    ];

    protected $casts = [
        'kapasitas_maksimal' => 'integer',
        'jumlah_siswa_saat_ini' => 'integer',
    ];

    public static function rules()
    {
        return [
            'nama_kelas' => 'required|string|max:255',
            'tingkat' => 'required|string',
            'tahun_ajaran' => 'required|string|size:9',
            'semester' => 'required|in:1,2',
            'kapasitas_maksimal' => 'required|integer|min:1',
        ];
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function waliKelas()
    {
        return $this->belongsTo(Teacher::class, 'wali_kelas_id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'class_student')
            ->withPivot('tahun_ajaran', 'semester', 'tanggal_masuk_kelas', 'tanggal_keluar_kelas', 'is_active')
            ->withTimestamps();
    }

    public function activeStudents()
    {
        return $this->students()->wherePivot('is_active', true);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'class_teacher')
            ->withPivot('subject_id', 'jam_per_minggu', 'tahun_ajaran', 'semester')
            ->withTimestamps();
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }

    public function scopeByTahunAjaran($query, $tahunAjaran)
    {
        return $query->where('tahun_ajaran', $tahunAjaran);
    }

    public function isFull()
    {
        return $this->jumlah_siswa_saat_ini >= $this->kapasitas_maksimal;
    }
}
