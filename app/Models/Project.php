<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;

/**
 * App\Models\Project
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $source_language_id
 * @property int|null $user_id
 * @property array|null $target_language_ids
 * @property bool $use_machine_translate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Collection|\App\Models\Document[] $documents
 * @property-read int|null $documents_count
 * @property-read \App\Models\Language|null $sourceLanguage
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\ProjectFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereSourceLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereTargetLanguageIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUseMachineTranslate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUserId($value)
 * @mixin \Eloquent
 */
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

    public function hasAccess(): bool
    {
        return $this->user_id === authUserId();
    }

    public function hasLang(int $languageId): bool
    {
        return in_array($languageId, $this->target_language_ids);
    }

    public function languagesCount(): int
    {
        return count($this->target_language_ids);
    }
}
