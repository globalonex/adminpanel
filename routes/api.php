<?php

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


// Protected routes: sanctum
Route::name('api.')->namespace('Api')->middleware(['auth:sanctum'])->group(function ($route) {
    $route->namespace('User')->group(function ($route) {

    });
});
