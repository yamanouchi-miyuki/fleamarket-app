<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExhibitionRequest;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Like;

class ItemController extends Controller
{
    public function index(Request $request)
    {   
        $user = Auth::user();
        $page = $request->query('page');
        $keyword = $request->query('keyword');

        $query = Item::with('images');

        if ($user && $page === 'sell') {
            // 自分が出品した商品だけ（出品状態に関係なく）
            $query->where('user_id', $user->id);

        } elseif ($user && $page === 'mylist') {
            // いいね済み or 購入済みの商品（出品状態に関係なく）
            $likedItemIds = $user->likes()->pluck('item_id');
            $purchasedItemIds = $user->purchases()->pluck('item_id');
            $mylistItemIds = $likedItemIds->merge($purchasedItemIds)->unique();
            $query->whereIn('id', $mylistItemIds);

        } elseif ($user) {
            // ログイン中のおすすめタブ
            $query->where('is_published', 1)
                ->where('user_id', '!=', $user->id); // ← これが今なかった可能性あり

        } else {
            // ログアウト中
            $query->where('is_published', 1);

            if ($user) {
            $query->where('user_id', '!=', $user->id);
        }
        }

        if ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }

        $items = !$user ? $query->take(10)->get() : $query->get();

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

            // 画像モデルを作成
            $image = new Image();
            $image->path = 'storage/' . $path;

            $item->images()->save($image);
        }
        return redirect()->route('mypage', ['page' => 'sell'])->with('success', '商品を出品しました！');
    }
}
