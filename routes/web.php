<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GeneralPagesController;

Route::get('/welcome', [GeneralPagesController::class, 'welcome'])->name('welcome');
Route::get('/', [GeneralPagesController::class, 'home'])->name('home');
Route::get('/shop', [GeneralPagesController::class, 'shop'])->name('shop');
Route::get('/about')->name('about');
Route::get('/contact')->name('contact');
Route::get('/blogs')->name('users.blogs');

Route::get('/cart')->name('cart');

Route::get('/list_categorised_products')->name('list_products_by_category');
Route::get('/products/search')->name('products.search');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
