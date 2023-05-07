<?php

use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\Products\ProductController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('/usergate')->group(function ($route) { // api
    $route->post('/login', [AuthController::class, "login"]);
    $route->post('/register', [AuthController::class, "register"]);
    $route->post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
//    $route->post('/forgot-pass', [AuthController::class, "forgotpass"]);
//    $route->post('/reset-pass', [AuthController::class, "reset_pass"]);
});

/*
 * TODO:
 * - Add   GET API categories for dishes
 * - Add   GET API products for dishes
 * - Add   POST API create products
 * - Add   POST API update products
 * - Add   POST API delete products
 * - Add   UI VUE Drawer for adding a product
 */

// Protected routes: sanctum

// Protected routes: sanctum
Route::name('api.')->middleware(['auth:sanctum'])->group(function ($route) {
    // Group for User related routes


    $route->group(['prefix' => '/products'], function () use ($route) {
        $route->get('/', [ProductController::class, 'index'])->name('products.index');
        $route->post('/store', [ProductController::class, 'store'])->name('products.store');
        $route->get('/{product}', [ProductController::class, 'show'])->name('products.show');
        $route->get('/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        $route->put('/{product}', [ProductController::class, 'update'])->name('products.update');
        $route->delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    });


    // Group for Category related routes
    $route->group(['prefix' => '/category'], function ($route) {
        $route->get('categories', [CategoryController::class, 'index']);
        $route->post('store', [CategoryController::class, 'store']);
        $route->get('categories/{category}', [CategoryController::class, 'show']);
        $route->put('categories/{category}', [CategoryController::class, 'update']);
        $route->delete('categories/{category}', [CategoryController::class, 'destroy']);
    });

});

