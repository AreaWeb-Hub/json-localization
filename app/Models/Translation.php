<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Arr;

/**
 * App\Models\Translation
 *
 * @property int $id
 * @property int|null $document_id
 * @property int|null $language_id
 * @property array|null $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Document|null $document
 * @property-read \App\Models\Language|null $language
 * @method static \Database\Factories\TranslationFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Translation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Translation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Translation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Translation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Translation whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Translation whereDocumentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Translation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Translation whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Translation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Translation extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id', 'language_id', 'data'
    ];

    protected $casts = [
        'data' => 'array'
    ];

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public function translatedSegmentsCount(): int
    {
        $translatedSegments = Arr::where($this->data, function ($item) {
            return !empty($item['value']) && is_string($item['value']);
        });

        return count($translatedSegments);
    }
}
