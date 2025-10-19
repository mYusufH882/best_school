<?php

namespace Modules\School\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

// use Modules\School\Database\Factories\ParentGuardianFactory;

class ParentGuardian extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'parents';

    protected $fillable = [
        'nik',
        'nama_lengkap',
        'no_hp',
        'email',
        'pekerjaan',
        'pendidikan_terakhir',
        'penghasilan_bulanan',
        'alamat_jalan',
        'rt',
        'rw',
        'dusun',
        'desa_kelurahan',
        'kecamatan',
        'kab_kota',
        'provinsi',
        'kode_pos',
    ];

    protected $casts = [
        'penghasilan_bulanan' => 'integer',
    ];

    public static function rules()
    {
        return [
            'nik' => 'required|digits:16|unique:parents,nik',
            'nama_lengkap' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
        ];
    }

        public function students()
    {
        return $this->belongsToMany(Student::class, 'student_parent')
            ->withPivot('hubungan', 'is_primary')
            ->withTimestamps();
    }

    // Helper method untuk get primary contact
    public function getPrimaryStudents()
    {
        return $this->students()->wherePivot('is_primary', true)->get();
    }
}
