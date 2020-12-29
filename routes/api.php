<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Frontend\UserController;
use  App\Http\Controllers\Frontend\AuthController;
use  App\Http\Controllers\Frontend\RolesController;
use  App\Http\Controllers\Frontend\ProductController;
use  App\Http\Controllers\Frontend\CategoryController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::group(['middleware' =>'auth:api'], function () {
    Route::get('user', [UserController::class, 'user']);
    Route::get('user/info', [UserController::class, 'updateInfo']);
    Route::get('user/password', [UserController::class, 'updatePassword']);
    Route::apiResource('roles', RolesController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('orders', CategoryController::class);
});
