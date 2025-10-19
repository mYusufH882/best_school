<?php

namespace Modules\School\App\Models;

use Illuminate\Database\Eloquent\Model;
// use Modules\School\Database\Factories\ClassTeacherFactory;

class ClassTeacher extends Model
{
    protected $table = 'class_teacher';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'class_id',
        'teacher_id',
        'subject_id',
        'jam_per_minggu',
        'tahun_ajaran',
        'semester',
    ];

    protected $casts = [
        'jam_per_minggu' => 'integer',
    ];

    public function class()
    {
        return $this->belongsTo(ClassRoom::class, 'class_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
