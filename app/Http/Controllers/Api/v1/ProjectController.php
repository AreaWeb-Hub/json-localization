<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Http\Resources\Project\MinifiedProjectResource;
use App\Http\Resources\Project\ProjectResource;
use App\Models\Project;
use App\Facades\Project as ProjectService;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('project.access')->only([
            'update', 'destroy'
        ]);
    }

    public function index()
    {
        return MinifiedProjectResource::collection(
            Project::query()
                ->where('user_id', authUserId())
                ->get()
        );
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
        return new ProjectResource($project);
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        return new ProjectResource(
            ProjectService::setProject($project)
                ->update($request->validated())
        );
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return responseOk();
    }
}
