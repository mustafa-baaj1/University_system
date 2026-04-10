<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classroom extends Model
{
    protected $fillable = ['building', 'room_number', 'capacity'];

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }
}

