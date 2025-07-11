<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit(){
        return view('mypage.profile');
    }

    public function update(AddressRequest $request){
        $user = Auth::user();

        $user->update([
            'name' => $request->name,
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'building_name' => $request->building_name, 
        ]);

        return redirect('/');
    }
}
