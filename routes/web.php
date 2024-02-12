<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeliveryAreaController;
use App\Http\Controllers\DeliveryLocationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CommentController;

Route::get('/', [HomeController::class, 'homepage'])->name('homepage');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/about', [HomeController::class, 'aboutpage'])->name('aboutpage');
Route::get('/contact', [HomeController::class, 'contactpage'])->name('contactpage');
Route::post('/contact', [CommentController::class, 'store'])->name('comments.store');

Route::get('/cart', [CartController::class, 'view_cart'])->name('cart');
Route::post('/cart/add/{id}', [CartController::class, 'add_to_cart'])->name('add_to_cart');
Route::post('/cart/quantity/{product_id}', [CartController::class, 'change_quantity'])->name('change_quantity');
Route::delete('/cart/remove/{productId}', [CartController::class, 'delete_from_cart'])->name('delete_from_cart');

Route::get('/areas/fetch/{areaId}', [OrderController::class, 'get_areas'])->name('get_areas');
Route::get('/area/fetch/shipping-price/{areaId}', [OrderController::class, 'get_shipping_price'])->name('get_shipping_price');

Route::get('/product/search', [ProductController::class, 'search_products'])->name('search_products');
Route::get('/product/{slug}', [ProductController::class, 'product_details'])->name('product_details');
Route::get('/category/{category_slug}', [ProductController::class, 'list_products_by_category'])->name('list_products_by_category');

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/checkout', [OrderController::class, 'get_checkout'])->name('get_checkout');
    Route::post('/checkout', [OrderController::class, 'post_checkout'])->name('post_checkout');
    Route::get('/order/success', [OrderController::class, 'order_success'])->name('order_success');

    Route::get('/orders/list', [OrderController::class, 'list_user_orders'])->name('list_user_orders');
});

require __DIR__.'/auth.php';


Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin_dashboard'])->name('admin_dashboard');

    Route::get('/admin/admins/list', [UserController::class, 'list_admins'])->name('list_admins');
    Route::get('/admin/admins/update/{id}', [UserController::class, 'get_update_admin'])->name('get_update_admin');
    Route::post('/admin/admins/update/{id}', [UserController::class, 'post_update_admin'])->name('post_update_admin');

    Route::get('/admin/users/list', [UserController::class, 'list_users'])->name('list_users');
    Route::get('/admin/users/update/{id}', [UserController::class, 'get_update_user'])->name('get_update_user');
    Route::post('/admin/users/update/{id}', [UserController::class, 'post_update_user'])->name('post_update_user');

    Route::prefix('admin')->group(function() {
        Route::resource('categories', CategoryController::class);

        Route::resource('products', ProductController::class);
        Route::get('product/delete_product_image/{id}', [ProductController::class, 'delete_product_image'])->name('delete_product_image');
        Route::post('product/product_images_sort', [ProductController::class, 'product_images_sort'])->name('product_images_sort');

        Route::resource('/delivery/locations', DeliveryLocationController::class);
        Route::resource('/delivery/areas', DeliveryAreaController::class);

        Route::resource('comments', CommentController::class)
        ->except('create', 'store', 'edit', 'update');
    });

    Route::get('/admin/orders/list', [OrderController::class, 'list_orders'])->name('list_orders');
    Route::get('/admin/orders/list_orders_table', [OrderController::class, 'list_orders_table'])->name('list_orders_table');
    Route::get('/admin/order/update/{id}', [OrderController::class, 'get_update_order'])->name('get_update_order');
    Route::post('/admin/order/update/{id}', [OrderController::class, 'post_update_order'])->name('post_update_order');
});
