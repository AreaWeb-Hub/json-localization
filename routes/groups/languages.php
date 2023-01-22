<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\LanguageController;

Route::controller(LanguageController::class)->prefix('v1/languages')->group(function () {
    Route::get('/', 'list')->name('languages.list');
});
