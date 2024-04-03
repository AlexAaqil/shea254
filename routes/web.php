<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GeneralPagesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeliveryAreaController;
use App\Http\Controllers\DeliveryLocationController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductMeasurementController;
use App\Http\Controllers\CartController;

Route::get('/welcome', [GeneralPagesController::class, 'welcome'])->name('welcome');
Route::get('/', [GeneralPagesController::class, 'home'])->name('home');
Route::get('/shop', [GeneralPagesController::class, 'shop'])->name('shop');
Route::get('/about', [GeneralPagesController::class, 'about'])->name('about');
Route::get('/contact', [GeneralPagesController::class, 'contact'])->name('contact');
Route::post('/contact', [CommentController::class, 'store'])->name('comments.store');
Route::get('/blogs', [BlogController::class, 'users_blogs'])->name('users.blogs');
Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'store'])->name('cart.store');
Route::post('/cart/quantity/{product_id}', [CartController::class, 'change_quantity'])->name('change_quantity');
Route::delete('/cart/remove/{productId}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::get('/checkout')->name('get_checkout');

Route::get('/list_categorised_products')->name('list_products_by_category');
Route::get('/products/search', [ProductController::class, 'search_products'])->name('products.search');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [DashboardController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified', 'admin'])->group(function() {
    Route::prefix('admin')->group(function() {
        Route::get('/dashboard', [DashboardController::class, 'admin_dashboard'])->name('admin.dashboard');

        Route::get('/admins', [UserController::class, 'admins'])->name('admin.admins');
        Route::get('/admins/{admin}/edit', [UserController::class, 'edit_admin'])->name('admin.edit');
        Route::patch('/admins/{admin}', [UserController::class, 'update_admin'])->name('admin.update');

        Route::get('/users', [UserController::class, 'users'])->name('admin.users');
        Route::get('/users/{user}/edit', [UserController::class, 'edit_user'])->name('user.edit');
        Route::patch('/users/{user}', [UserController::class, 'update_user'])->name('user.update');

        Route::resource('/product-measurements', ProductMeasurementController::class)->except('show');
        Route::resource('/product-categories', ProductCategoryController::class)->except('show');
        Route::resource('/products', ProductController::class);
        Route::get('product/product-image/delete/{id}', [ProductController::class, 'delete_product_image'])->name('delete_product_image');
        Route::post('product/product_images_sort', [ProductController::class, 'product_images_sort'])->name('product_images_sort');


        Route::resource('/delivery/locations', DeliveryLocationController::class)->except('show');
        Route::resource('/delivery/areas', DeliveryAreaController::class)->except('show');

        Route::resource('/blog-categories', BlogCategoryController::class)->except('show');
        Route::resource('/blogs', BlogController::class)->except('show');

        Route::resource('/comments', CommentController::class)->except('create', 'store', 'edit', 'update');
    });
});
