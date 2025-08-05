<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ExhibitionRequest;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ExhibitionController extends Controller
{
    public function store(ExhibitionRequest $request){

        $validated = $request->validated();

        $path = $request->file('image')->store('public/items');
        $filename = basename($path);

        $item = new Item();
        $item->user_id = Auth::id();
        $item->name = $validated['name'];
        $item->description = $validated['description']; 
        $item->price = $validated['price'];
        $item->condition = $validated['condition'];
        $item->brand_name = $validated['brand_name'] ?? null;
        $item->is_sold = 0;
        $item->is_published = 1;
        $item->save();

        $item->categories()->attach($validated['category_ids']);
        return redirect()->route('mypage')->with('success', '商品を出品しました');
    }
}
