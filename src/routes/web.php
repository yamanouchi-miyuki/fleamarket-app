<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ExhibitionController;
use App\Http\Controllers\TestRegisterController;

Route::get('/', [ItemController::class, 'index'])->name('items.index');
Route::get('/item/{id}', [ItemController::class, 'show'])->name('items.show');
Route::post('/comments', [CommentController::class, 'store'])->middleware('auth')->name('comments.store');
Route::get('/sell', [ItemController::class, 'create'])->name('sell');
Route::post('/items', [ItemController::class, 'store'])->name('items.store');
Route::get('/purchase/{item}', [PurchaseController::class, 'index'])->name('purchase.index');
Route::middleware(['auth'])->group(function () {
    Route::get('/mypage', [ProfileController::class, 'index'])->name('mypage');
        Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/mypage/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/mypage/profile', [ProfileController::class, 'update']);
        Route::post('/like', [LikeController::class, 'store'])->name('like');
        Route::delete('/like', [LikeController::class, 'destroy'])->name('unlike');});
Route::middleware(['auth'])->group(function () {
    Route::get('/purchase/{item}', [PurchaseController::class, 'index'])->name('purchase.index');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/purchase/address/{item_id}', [AddressController::class, 'edit'])->name('address.edit');
    Route::put('/purchase/address/{item_id}', [AddressController::class, 'update'])->name('address.update');
});
Route::post('/purchase/{item_id}', [PurchaseController::class, 'store'])->name('purchase.store');
Route::middleware(['auth'])->group(function (){
    Route::get('/sell', [ItemController::class, 'create'])->name('sell');
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');
});
Route::post('/test-register', [TestRegisterController::class, 'store']);