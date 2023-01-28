<?php

namespace App\Http\Middleware;

use App\Exceptions\Project\InvalidLanguageException;
use App\Models\Document;
use App\Models\Project;
use Closure;
use Illuminate\Http\Request;
use function PHPUnit\Framework\assertDirectoryDoesNotExist;

class CheckProjectTargetLangMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     * @throws InvalidLanguageException
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var Document $document */
        $document = $request->route('document');

        /** @var Project $project */
        $project = $document->project;

        $languageId = $request->input('lang');

        if (!$project->hasLang($languageId)) {
            throw new InvalidLanguageException();
        }

        return $next($request);
    }
}
