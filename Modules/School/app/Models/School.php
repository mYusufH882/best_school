<?php

namespace Modules\School\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'npsn',
        'nss',
        'nama_sekolah',
        'jenjang',
        'status',
        'akreditasi',
        'sk_pendirian',
        'tanggal_sk_pendirian',
        'alamat_jalan',
        'rt',
        'rw',
        'dusun',
        'desa_kelurahan',
        'kecamatan',
        'kab_kota',
        'provinsi',
        'kode_pos',
        'latitude',
        'longitude',
        'telepon',
        'email',
        'website',
        'kurikulum',
        'nama_kepsek',
        'nip_kepsek',
    ];

    protected $casts = [
        'kurikulum' => 'array',
        'tanggal_sk_pendirian' => 'date',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    // Validasi
    public static function rules()
    {
        return [
            'npsn' => 'required|digits:8|unique:schools,npsn',
            'nama_sekolah' => 'required|string|max:255',
            'jenjang' => 'required|in:TK,RA,SD,MI,Diniyah,SMP,MTs,SMA,MA,SMK',
            'status' => 'required|in:negeri,swasta',
            'rt' => 'required|digits_between:1,3',
            'rw' => 'required|digits_between:1,3',
            'kode_pos' => 'required|digits:5',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ];
    }

    // Relasi
    public function profile()
    {
        return $this->hasOne(SchoolProfile::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }

    public function classes()
    {
        return $this->hasMany(ClassRoom::class);
    }

    // Accessor
    public function getAlamatLengkapAttribute()
    {
        return implode(', ', array_filter([
            $this->alamat_jalan,
            "RT {$this->rt}/RW {$this->rw}",
            $this->dusun,
            $this->desa_kelurahan,
            $this->kecamatan,
            $this->kab_kota,
            $this->provinsi,
            $this->kode_pos,
        ]));
    }

    public function setNameAttribute($value)
    {
        $this->attributes['nama_sekolah'] = $value;
    }
}
