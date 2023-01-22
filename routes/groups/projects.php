<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\ProjectController;

Route::apiResource('v1/projects', ProjectController::class)
    ->middleware('auth:sanctum');
