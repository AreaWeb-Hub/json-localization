<?php

namespace App\Services\Project;

use App\Models\Project;
use Illuminate\Support\Arr;

class ProjectService
{
    public function create(array $data): Project
    {
        // ПОЧИТАЙТЕ: тут лучше использовать DTO (Data Transfer Object)
        // Например: https://github.com/spatie/data-transfer-object

        return Project::query()->create([
            'name' => Arr::get($data, 'name'),
            'description' => Arr::get($data, 'description'),
            'source_language_id' => Arr::get($data, 'languages.source'),
            'target_language_ids' => Arr::get($data, 'languages.target'),
            'use_machine_translate' => Arr::get($data, 'settings.useMachineTranslate'),
            'user_id' => authUserId()
        ]);
    }
}
