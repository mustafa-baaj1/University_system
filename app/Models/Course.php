<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    protected $fillable = ['name', 'code', 'description', 'program_id'];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }

    public function prerequisites(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'prerequisites', 'course_id', 'prerequisite_id');
    }

    public function dependentCourses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'prerequisites', 'prerequisite_id', 'course_id');
    }
}

