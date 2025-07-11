<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExhibitionRequest;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class ItemController extends Controller
{
    public function index(){
        $items = Item::with('images')->get();
        return view('items.index', compact('items'));
    }

    public function show($id){
        $item = Item::with(['user', 'images', 'categories', 'comments'])->findOrFail($id);
        return view('items.show', compact('item'));
    }

    public function create(){
        $categories = Category::all();
        return view('sell', compact('categories'));
    }

    public function store(ExhibitionRequest $request){
        $item = new Item();
        $item->user_id = auth()->id();
        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->condition = $request->condition;
        $item->brand_name = $request->brand_name;
        $item->save();
        $item->categories()->sync($request->input('categories', []));

        if ($request->hasFile('image')){
            $path = $request->file('image')->store('items', 'public');
            $image = new Image([
                'item_id' => $item->id,
                'path' => 'storage/' . $path,
            ]);
            $image->save();
        }
        return redirect()->route('items.index')->with('success', '商品を出品しました！');
    }
}
