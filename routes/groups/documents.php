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
    Route::get('/', 'list')
        ->name('documents.list')
        ->middleware('document.list.access');
    Route::delete('/{document}', 'destroy')
        ->name('documents.destroy')
        ->middleware('document.access');
    Route::post('/{document}/import', 'import')
        ->name('documents.import')
        ->middleware('document.access');
    Route::get('/{document}', 'show')
        ->name('documents.show')
        ->middleware('document.access');
});
