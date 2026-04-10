<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Assignment extends Model
{
    protected $fillable = ['section_id', 'title', 'description', 'due_date', 'max_score'];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class);
    }
}

