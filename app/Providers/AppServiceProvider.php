<?php

namespace App\Providers;

use App\Http\Resources\Account\UserResource;
use App\Services\Account\AccountService;
use App\Services\Project\ProjectService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */

    public function register()
    {
        $this->app->bind('account_service', AccountService::class);
        $this->app->bind('projects', ProjectService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        UserResource::withoutWrapping();
    }
}
