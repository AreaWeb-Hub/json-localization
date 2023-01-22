<?php

namespace App\Http\Middleware\Document;

use App\Exceptions\Account\NoAccessToOperationException;
use App\Models\Document;
use App\Models\Project;
use Closure;
use Illuminate\Http\Request;

class DocumentAccessMiddleware
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
        /** @var Document $document */
        $document = $request->route('document');

        /** @var Project $project */
        $project = $document->project;

        if (!$project->hasAccess()) {
            throw new NoAccessToOperationException();
        }

        return $next($request);
    }
}
