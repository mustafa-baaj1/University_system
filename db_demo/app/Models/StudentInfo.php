<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentInfo extends Model
{
    protected $table = "student_info_view";
    public $incrementing = false;

    protected static function booted(){
        static::saving(fn()=>false);
        static::deleting(fn()=>false);
        static::updating(fn()=>false);

    }

}
