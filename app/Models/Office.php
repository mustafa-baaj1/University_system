<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Office extends Model
{
    protected $fillable = ['building', 'room_number'];

    public function instructor(): HasOne
    {
        return $this->hasOne(Instructor::class);
    }
}

