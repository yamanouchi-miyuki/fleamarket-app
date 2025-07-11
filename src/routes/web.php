<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\LikeController;

Route::get('/', [ItemController::class, 'index']);
Route::get('/item/{id}', [ItemController::class, 'show'])->name('items.show');
Route::post('/comment', [CommentController::class, 'store'])->name('comments.store');
Route::get('/purchase/{id}', [PurchaseController::class, 'show'])->name('purchase.show');
Route::get('/sell', [ItemController::class, 'create'])->name('sell');
// Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
Route::post('/items', [ItemController::class, 'store'])->name('items.store');
Route::view('/register', 'auth.register')->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');
Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login');
Route::get('/purchase/{item}', [PurchaseController::class, 'index'])->name('purchase.index');
Route::view('/purchase/address/{item}', 'purchase.address')->name('purchase.address');
Route::get('/mypage', function (){
    return view('mypage.index');
})->middleware(['auth'])->name('mypage');
Route::get('/mypage/profile', [ProfileController::class, 'edit'])->middleware(['auth'])->name('profile.edit');
Route::middleware(['auth'])->group(function (){
    Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/mypage/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Route::get('/mypage', [MypageController::class, 'index'])->name('mypage.buy')->middleware('auth');
Route::post('/like', [LikeController::class, 'store'])->name('like');
Route::delete('/like', [LikeController::class, 'destroy'])->name('unlike');