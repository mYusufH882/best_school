<?php

namespace Modules\School\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolProfile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'school_id',
        'name',
        'tagline',
        'about',
        'primary_color',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
