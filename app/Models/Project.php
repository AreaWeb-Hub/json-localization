<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description',
        'source_language_id', 'target_language_ids',
        'use_machine_translate', 'user_id'
    ];

    protected $casts = [
        'target_language_ids' => 'array',
        'use_machine_translate' => 'bool'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sourceLanguage(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'source_language_id');
    }

    public function targetLanguages(): Collection
    {
        return Language::query()
            ->whereIn('id', $this->target_language_ids)
            ->get();
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}
