<?php

namespace App\Providers;

use App\Services\MoodleAuthService;
use Illuminate\Support\ServiceProvider;
use App\Contracts\AuthServiceContract;

class AuthServiceProvider extends ServiceProvider
{

    protected $defer = true;

    public function register()
    {
        $this->app->singleton(AuthServiceContract::class, function ($app) {
            return new MoodleAuthService();
        });
    }

    public function boot()
    {
        //
    }

    public function provides()
    {
        return [AuthServiceContract::class];
    }
}
