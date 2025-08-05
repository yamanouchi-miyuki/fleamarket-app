<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddressRequest;

class AddressController extends Controller
{
    public function edit($item_id)
{
    $user = Auth::user();
    return view('address.edit', compact('user', 'item_id'));
}
    public function update(Request $request, $item_id)
{
    $user = Auth::user();
    $user->update([
        'postal_code' => $request->postal_code,
        'address' => $request->address,
        'building_name' => $request->building_name,
    ]);

    return redirect()->route('purchase.index', ['item' => $item_id]);
}
}
