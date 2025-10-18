<?php

namespace Modules\School\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\School\Database\Factories\SchoolProfileFactory;

class SchoolProfile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'tagline',
        'about',
        'primary_color',
    ];

    // protected static function newFactory(): SchoolProfileFactory
    // {
    //     // return SchoolProfileFactory::new();
    // }
}
