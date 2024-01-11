<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductSizeController;
use App\Http\Controllers\ProductController;

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

Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/product/{slug}', [ProductController::class, 'product_details'])->name('product_details');

Route::get('/about', [HomeController::class, 'aboutpage'])->name('aboutpage');

Route::get('/contact', [HomeController::class, 'contactpage'])->name('contactpage');

Route::get('/cart', [OrderController::class, 'view_cart'])->name('cart');
Route::post('/cart/add/{id}', [OrderController::class, 'add_to_cart'])->name('add_to_cart');
Route::get('/checkout', [OrderController::class, 'get_checkout'])->name('get_checkout');
Route::post('/checkout', [OrderController::class, 'post_checkout'])->name('post_checkout');

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/admin/admins/list', [UserController::class, 'list_admins'])->name('list_admins');
    Route::get('/admin/admins/update/{id}', [UserController::class, 'get_update_admin'])->name('get_update_admin');
    Route::post('/admin/admins/update/{id}', [UserController::class, 'post_update_admin'])->name('post_update_admin');

    Route::get('/admin/users/list', [UserController::class, 'list_users'])->name('list_users');
    Route::get('/admin/users/update/{id}', [UserController::class, 'get_update_user'])->name('get_update_user');
    Route::post('/admin/users/update/{id}', [UserController::class, 'post_update_user'])->name('post_update_user');

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

    Route::get('/admin/products/list', [ProductController::class, 'list'])->name('list_products');
    Route::get('/admin/product/add', [ProductController::class, 'get_add_product'])->name('get_add_product');
    Route::post('/admin/product/add', [ProductController::class, 'post_add_product'])->name('post_add_product');
    Route::get('/admin/product/update/{id}', [ProductController::class, 'get_update_product'])->name('get_update_product');
    Route::post('/admin/product/update/{id}', [ProductController::class, 'post_update_product'])->name('post_update_product');
    Route::delete('/admin/products/delete/{id}', [ProductController::class, 'delete_product'])->name('delete_product');
    Route::get('/admin/product/delete_product_image/{id}', [ProductController::class, 'delete_product_image'])->name('delete_product_image');
    Route::post('/admin/product/product_images_sort', [ProductController::class, 'product_images_sort'])->name('product_images_sort');

    Route::get('/admin/locations/list', [LocationController::class, 'list'])->name('list_locations');
    Route::get('/admin/location/city/add', [LocationController::class, 'get_add_city'])->name('get_add_city');
    Route::post('/admin/location/city/add', [LocationController::class, 'post_add_city'])->name('post_add_city');
    Route::get('/admin/location/city/update/{id}', [LocationController::class, 'get_update_city'])->name('get_update_city');
    Route::post('/admin/location/city/update/{id}', [LocationController::class, 'post_update_city'])->name('post_update_city');
    Route::delete('/admin/location/city/delete/{id}', [LocationController::class, 'delete_city'])->name('delete_city');

    Route::get('/admin/location/town/add', [LocationController::class, 'get_add_town'])->name('get_add_town');
    Route::post('/admin/location/town/add', [LocationController::class, 'post_add_town'])->name('post_add_town');
    Route::get('/admin/location/town/update/{id}', [LocationController::class, 'get_update_town'])->name('get_update_town');
    Route::post('/admin/location/town/update/{id}', [LocationController::class, 'post_update_town'])->name('post_update_town');
    Route::delete('/admin/location/town/delete/{id}', [LocationController::class, 'delete_town'])->name('delete_town');
});
