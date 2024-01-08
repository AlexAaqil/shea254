<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

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

    Route::get('/admin/categories/list', [CategoryController::class, 'list_categories'])->name('list_categories');
    Route::post('/admin/categories/add', [CategoryController::class, 'add_category'])->name('add_category');
    Route::patch('/admin/categories/update', [CategoryController::class, 'update_category'])->name('update_category');
    Route::delete('/admin/categories/delete', [CategoryController::class, 'delete_category'])->name('delete_category');
});
