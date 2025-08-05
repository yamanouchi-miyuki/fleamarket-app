<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Laravel\Fortify\Http\Requests\RegisterRequest as FortifyRegisterRequest;
use App\Http\Requests\RegisterRequest;
use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\RegisterResponse;
use App\Http\Responses\CustomRegisterResponse;
use App\Http\Controllers\Auth\RegisteredUserController;
use Laravel\Fortify\Contracts\LoginResponse;
use App\Http\Responses\CustomLoginResponse;

class FortifyServiceProvider extends ServiceProvider
{
    
    public function register(): void
    {
        $this->app->singleton(RegisterResponse::class, CustomRegisterResponse::class);
        
    }

    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::loginView(function () {
            return view('auth.login');
        });

        Fortify::registerView(function () {
            return view('auth.register');
        });

        $this->app->bind(
            FortifyRegisterRequest::class, RegisterRequest::class);

        $this->app->bind(FortifyLoginRequest::class, LoginRequest::class);

        $this->app->singleton(LoginResponse::class, CustomLoginResponse::class);

        $this->app->singleton(RegisterResponse::class, CustomRegisterResponse::class);

    }
}
