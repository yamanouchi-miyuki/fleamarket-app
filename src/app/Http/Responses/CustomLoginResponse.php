<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Auth;

class CustomLoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {   
        $user = Auth::user();

        // プロフィール未登録ならプロフィール設定画面へ
        if (!$user->is_profile_registered) {
            return redirect()->route('profile.edit');
        }

        // それ以外は商品一覧へ
        return redirect()->route('items.index');
    }
}
