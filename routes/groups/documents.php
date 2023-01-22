<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\DocumentController;

Route::controller(DocumentController::class)
    ->middleware('auth:sanctum')
    ->prefix('v1/documents')
    ->group(function () {
    Route::post('/', 'add')
        ->name('documents.add')
        ->middleware('document.add.access');
});
