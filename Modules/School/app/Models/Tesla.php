<?php

namespace Modules\School\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\School\Database\Factories\TeslaFactory;

class Tesla extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): TeslaFactory
    // {
    //     // return TeslaFactory::new();
    // }
}
