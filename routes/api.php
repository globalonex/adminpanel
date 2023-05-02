<?php

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


    // Group for Product related routes
    $route->resource('products', ProductController::class)->names([
        'index' => 'products.index',
        'create' => 'products.create',
        'store' => 'products.store',
        'show' => 'products.show',
        'edit' => 'products.edit',
        'update' => 'products.update',
        'destroy' => 'products.destroy',
    ]);

    // Group for Category related routes
    Route::group(['prefix' => 'category'], function ($route) {
        $route->get('categories', '\App\Http\Controllers\Api\Category\CategoryController@index');
        $route->post('categories', 'CategoryController@store');
        $route->get('categories/{category}', 'CategoryController@show');
        $route->put('categories/{category}', 'CategoryController@update');
        $route->delete('categories/{category}', 'CategoryController@destroy');
    });

});

