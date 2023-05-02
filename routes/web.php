<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MainController::class, 'index']);

Route::middleware(['authed.inertia'])->group(function ($route) {
    $route->get('/login', [MainController::class, 'login_page'])->name('login');
    $route->get('/register', [MainController::class, 'register_page'])->name('register');
});

Route::prefix('/admin')->middleware(['auth.inertia'])->group(function ($route) {
    $route->get('/', [MainController::class, "admin_page"])->name('admin');
    $route->get('/dishes', [MainController::class, "dishes_page"])->name('admin.dishes');
    $route->get('/categories', [MainController::class, "categories_page"])->name('admin.categories');
});
