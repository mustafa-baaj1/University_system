<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Instructor extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'address', 'department_id', 'office_id'];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }

    public function sections(): BelongsToMany
    {
        return $this->belongsToMany(Section::class, 'teachers_sections');
    }
}

