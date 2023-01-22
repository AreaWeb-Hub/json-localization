<?php

namespace App\Services\Document;

use App\Models\Document;
use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentService
{
    private Project $project;

    public function add(array $documents): DocumentService
    {
        $this->project->documents()->createMany($documents);
        return $this;
    }

    public function setProject(Project|int $project): DocumentService
    {
        $this->project = $project instanceof Project
            ? $project
            : Project::query()->findOrFail($project);

        return $this;
    }

    public function list(): Collection
    {
        return $this->project->documents()->get();
    }
}
