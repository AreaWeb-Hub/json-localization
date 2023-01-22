<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Services\Document\DocumentService setProject(\App\Models\Project|int $project)
 * @method static \App\Services\Document\DocumentService add(array $documents)
 *
 * @see \App\Services\Document\DocumentService
 */
class Document extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'documents';
    }
}
