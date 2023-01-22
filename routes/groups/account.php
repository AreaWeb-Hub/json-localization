<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\AccountController;

Route::controller(AccountController::class)->prefix('v1/account')->group(function () {
    Route::post('create', 'create')->name('account.create');
    Route::post('sign-in', 'signIn')->name('account.sign-in');
});
