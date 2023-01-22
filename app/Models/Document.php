<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id', 'name', 'data', 'progress'
    ];

    protected $casts = [
        'data' => 'array',
        'progress' => 'float'
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function status(): string
    {
        if ($this->progress === 0) {
            return 'created';
        } elseif ($this->progress > 0 && $this->progress < 100) {
            return 'in progress';
        }

        return 'completed';
    }
}
