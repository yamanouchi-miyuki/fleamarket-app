<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Purchase;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function index(Request $request){
        $user = Auth::user();

        if ($request->page === 'buy') {

            $purchasedItemIds = $user->purchases->pluck('item_id');
            $items = Item::with('images')->whereIn('id', $purchasedItemIds)->get();

            } elseif ($request->page === 'sell') {
                $items = Item::with('images')->where('user_id', $user->id)->get();
                } else {
                    $items = collect();
                }

        return view('mypage.index', compact('user', 'items'));
    }
    
    
    public function edit(){
        $user = Auth::user();
        return view('mypage.profile', compact('user'));
    }

    public function update(Request $request)
    {
        // 1. バリデーション：住所（手動で AddressRequest を使う）
        $addressRequest = app(AddressRequest::class);
        $addressValidator = \Validator::make(
            $request->all(),
            $addressRequest->rules(),
            $addressRequest->messages()
        );
        $addressValidator->validate();

        // 2. バリデーション：画像（手動で ProfileRequest を使う）
        $profileRequest = app(ProfileRequest::class);
        $profileValidator = \Validator::make(
            array_merge($request->all(), [
                'profile_image' => $request->file('profile_image'),
            ]),
            $profileRequest->rules(),
            $profileRequest->messages()
        );
        $profileValidator->validate();

        // 3. 保存処理
        $user = Auth::user();
        $user->name = $request->name;
        $user->postal_code = $request->postal_code;
        $user->address = $request->address;
        $user->building_name = $request->building_name;

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $path;
        }

        $user->is_profile_registered = true;

        $user->save();

        return redirect('/');
    }
}
