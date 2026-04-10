<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Submission extends Model
{
    protected $table = 'submisions';
    
    protected $fillable = [
        'assignment_id', 
        'student_id', 
        'file', 
        'submitted_at', 
        'status', 
        'feedback', 
        'feedback_comment', 
        'score'
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
    ];

    public function assignment(): BelongsTo
    {
        return $this->belongsTo(Assignment::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}

