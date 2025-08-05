<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PurchaseRequest;
use App\Models\Purchase;

class PurchaseController extends Controller
{
    public function index($id){
        $item = Item::findOrFail($id);
        $user = Auth::user();

        return view('purchase.index', compact('item', 'user'));
    }

    public function store(PurchaseRequest $request, $item_id){
        $validated = $request->validated();

        $item = Item::findOrFail($item_id);
        if ($item->is_sold) {
            return redirect()->back()->withErrors(['item' => 'この商品はすでに購入されています。']);
        }
        $item->is_sold = 1;
        $item->save();

        Purchase::create([
        'user_id' => auth()->id(),
        'item_id' => $item->id,
        'payment_method' => $validated['payment_method'],
        ]);

        return redirect('/mypage')->with('success', '購入が完了しました');
    }
}
