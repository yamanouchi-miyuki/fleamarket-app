<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function store(LoginRequest $request){
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)){
            throw ValidationException::withMessages([
                'email' => 'ログイン情報が登録されていません。',
            ]);
        }
        return redirect()->intended('/');
    }

    public function authenticated(Request $request, $user){
        if (!$user->is_profile_registered) {
            return redirect('/mypage/profile');
        }
        
        return redirect('/');
    }
}
