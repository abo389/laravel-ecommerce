<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductPageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductPageController::class, "index"])->name("home");
Route::get('/product_details/{id}', [ProductPageController::class, "show"])->name("product_details");

Route::get("cart", [CartController::class, "index"])->name("cart.index");
Route::post('cart/{id}', [CartController::class, "store"])->name("cart.store");
Route::post('update-qty', [CartController::class, "update_qty"])->name("cart.update_qty");
Route::delete("cart/{id}", [CartController::class, "destroy"])->name("cart.destroy");

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';


Route::resource("product", ProductController::class);