<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\RegisterResponse;
use App\Http\Responses\CustomRegisterResponse;
use Laravel\Fortify\Contracts\LoginResponse;
use App\Http\Responses\CustomLoginResponse;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(RegisterResponse::class, CustomRegisterResponse::class);

        $this->app->singleton(LoginResponse::class,CustomLoginResponse::class);
    }

    public function boot()
    {
        
    }
}
