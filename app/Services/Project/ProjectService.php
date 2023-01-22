<?php

namespace App\Services\Project;

use App\Models\Project;
use Illuminate\Support\Arr;

class ProjectService
{
    private Project $project;

    public function create(array $data): Project
    {
        return Project::query()->create([
            'name' => Arr::get($data, 'name'),
            'description' => Arr::get($data, 'description'),
            'source_language_id' => Arr::get($data, 'languages.source'),
            'target_language_ids' => Arr::get($data, 'languages.target'),
            'use_machine_translate' => Arr::get($data, 'settings.useMachineTranslate'),
            'user_id' => authUserId()
        ]);
    }

    public function update(array $data): Project
    {
        // ПОЧИТАЙТЕ: тут лучше использовать DTO (Data Transfer Object)
        // Например: https://github.com/spatie/data-transfer-object

        $this->project->update(
            $this->mapProjectData($data)
        );

        return $this->project;
    }

    /**
     * @param Project $project
     * @return ProjectService
     */
    public function setProject(Project $project): ProjectService
    {
        $this->project = $project;
        return $this;
    }

    private function mapProjectData(array $data): array
    {
        $mappedData = [];
        $dotArray = Arr::dot($data);
        foreach ($dotArray as $key => $value) {
            $mappedData[$this->getTableField($key)] = $value;
        }
        return $mappedData;
    }

    private function getTableField(string $key): string
    {
        $fields = [
            'name' => 'name',
            'description' => 'description',
            'languages.source' => 'source_language_id',
            'languages.target' => 'target_language_ids',
            'settings.useMachineTranslate' => 'use_machine_translate',
        ];

        return $fields[$key];
    }
}
