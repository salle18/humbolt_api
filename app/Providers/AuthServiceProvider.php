<?php

namespace App\Providers;

use App\Contracts\AuthServiceContract;
use App\Services\MoodleAuthService;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    protected $defer = true;

    public function register()
    {
        $this->app->singleton(AuthServiceContract::class, function () {
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
