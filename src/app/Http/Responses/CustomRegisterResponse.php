<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomRegisterResponse implements RegisterResponseContract
{
    public function toResponse($request)
    {
        Auth::logout();

        return redirect()->route('login');
        // return redirect('/mypage/profile');
    }
}
