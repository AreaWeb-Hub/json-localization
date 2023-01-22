<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Models\Project create(array $data)
 * @method static \App\Services\Project\ProjectService setProject(\App\Models\Project $project)
 *
 * @see \App\Services\Project\ProjectService
 */
class Project extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'projects';
    }
}
