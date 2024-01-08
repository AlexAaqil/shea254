<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductSizeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'homepage'])->name('homepage');

Route::get('/about', [HomeController::class, 'aboutpage'])->name('aboutpage');

Route::get('/contact', [HomeController::class, 'contactpage'])->name('contactpage');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', [HomeController::class, 'index'])
->middleware('auth')
->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/admin/admins/list', [UserController::class, 'list_admins'])->name('list_admins');
    Route::get('/admin/users/list', [UserController::class, 'list_users'])->name('list_users');
    Route::patch('/admin/admins/update', [UserController::class, 'update_user'])->name('update_user');

    Route::get('/admin/categories/list', [CategoryController::class, 'list'])->name('list_categories');
    Route::get('/admin/categories/add', [CategoryController::class, 'get_add_category'])->name('get_add_category');
    Route::post('/admin/categories/add', [CategoryController::class, 'post_add_category'])->name('post_add_category');
    Route::get('/admin/categories/update/{id}', [CategoryController::class, 'get_update_category'])->name('get_update_category');
    Route::post('/admin/categories/update/{id}', [CategoryController::class, 'post_update_category'])->name('post_update_category');
    Route::delete('/admin/categories/delete/{id}', [CategoryController::class, 'delete_category'])->name('delete_category');

    Route::get('/admin/productsizes/list', [ProductSizeController::class, 'list'])->name('list_product_sizes');
    Route::get('/admin/productsize/add', [ProductSizeController::class, 'get_add_product_size'])->name('get_add_product_size');
    Route::post('/admin/productsize/add', [ProductSizeController::class, 'post_add_product_size'])->name('post_add_product_size');
    Route::get('/admin/productsize/update/{id}', [ProductSizeController::class, 'get_update_product_size'])->name('get_update_product_size');
    Route::post('/admin/productsize/update/{id}', [ProductSizeController::class, 'post_update_product_size'])->name('post_update_product_size');
    Route::delete('/admin/productsize/delete/{id}', [ProductSizeController::class, 'delete_product_size'])->name('delete_product_size');
});
