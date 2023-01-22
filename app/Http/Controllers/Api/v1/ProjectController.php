<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Http\Resources\Project\ProjectResource;
use App\Models\Project;
use App\Facades\Project as ProjectService;

class ProjectController extends Controller
{
    public function index()
    {
        //
    }

    public function store(StoreProjectRequest $request)
    {
        return new ProjectResource(
            ProjectService::create(
                $request->validated()
            )
        );
    }

    public function show(Project $project)
    {
        //
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        //
    }

    public function destroy(Project $project)
    {
        //
    }
}
