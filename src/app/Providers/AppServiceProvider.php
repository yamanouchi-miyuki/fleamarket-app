<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\RegisterResponse;
use App\Http\Responses\CustomRegisterResponse;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(RegisterResponse::class, CustomRegisterResponse::class);
    }

    public function boot()
    {
        
    }
}
