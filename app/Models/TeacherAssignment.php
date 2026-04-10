<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeacherAssignment extends Model
{
    protected $table = 'teachers_sections';
    
    protected $fillable = ['section_id', 'instructor_id'];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(Instructor::class);
    }
}

