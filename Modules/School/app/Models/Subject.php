<?php

namespace Modules\School\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\School\Database\Factories\SubjectFactory;

class Subject extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'kode_mapel',
        'nama_mapel',
        'kelompok',
        'jenjang',
    ];

    protected $casts = [
        'jenjang' => 'array',
    ];

    public static function rules()
    {
        return [
            'kode_mapel' => 'required|string|max:10|unique:subjects,kode_mapel',
            'nama_mapel' => 'required|string|max:255',
            'kelompok' => 'required|in:A,B,C',
        ];
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'subject_teacher')
            ->withTimestamps();
    }

    public function classTeachings()
    {
        return $this->hasMany(ClassTeacher::class);
    }

    public function scopeByJenjang($query, $jenjang)
    {
        return $query->whereJsonContains('jenjang', $jenjang);
    }
}
