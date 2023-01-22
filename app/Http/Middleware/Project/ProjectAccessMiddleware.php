<?php

namespace App\Http\Middleware\Project;

use App\Exceptions\Account\NoAccessToOperationException;
use App\Models\Project;
use Closure;
use Illuminate\Http\Request;

class ProjectAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     * @throws NoAccessToOperationException
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var Project $project */
        $project = $request->route('project');

        if (!$project->hasAccess()) {
            throw new NoAccessToOperationException();
        }

        return $next($request);
    }
}
