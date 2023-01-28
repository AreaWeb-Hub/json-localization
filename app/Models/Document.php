<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Document
 *
 * @property int $id
 * @property int|null $project_id
 * @property string|null $name
 * @property array|null $data
 * @property float|null $progress
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Project|null $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Translation[] $translations
 * @property-read int|null $translations_count
 * @method static \Database\Factories\DocumentFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Document newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Document newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Document query()
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereProgress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

    public function translations(): HasMany
    {
        return $this->hasMany(Translation::class);
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

    /**
     * Кол-во сегментов (элементов) в data
     * этого документа
     * @return int
     */
    public function segmentsCount(): int
    {
        return count($this->data);
    }

    /**
     * Кол-во сегментов (элементов) в data * кол-во языков в проекте
     * @return int
     */
    public function totalSegments(): int
    {
        return $this->segmentsCount() * $this->project->languagesCount();
    }

    public function translatedSegmentsCount(): int
    {
        $translatedSegmentsCount = 0;

        foreach ($this->translations as $translation) {
            $translatedSegmentsCount += $translation->translatedSegmentsCount();
        }

        return $translatedSegmentsCount;
    }
}
