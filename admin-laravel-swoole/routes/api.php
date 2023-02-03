<?php

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

use App\Http\Controllers\Api\V1\Admin\DashboardController;
use App\Http\Controllers\Api\V1\Admin\ImageController;
use App\Http\Controllers\Api\V1\Admin\OrderController;
use App\Http\Controllers\Api\V1\Admin\PermissionController;
use App\Http\Controllers\Api\V1\Admin\ProductController;
use App\Http\Controllers\Api\V1\Admin\RoleController;
use App\Http\Controllers\Api\V1\Admin\UserController;
use App\Http\Controllers\Api\V1\Auth\AuthController;

Route::get('/', static function () {
    return 'API is working!';
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->name('login');
    Route::post('register', 'register')->name('register');
});

Route::group([
    'middleware' => ['auth:api'],
    'prefix' => 'admin',
], static function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('user', 'user');
        Route::put('users/info', 'updateInfo');
        Route::put('users/password', 'updatePassword');
    });

    Route::get('export', [OrderController::class, 'export']);
    Route::get('chart', [DashboardController::class, 'chart']);
    Route::post('upload', [ImageController::class, 'upload']);

    Route::apiResource('users', UserController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('orders', OrderController::class)->only('index', 'show');
    Route::apiResource('permissions', PermissionController::class)->only('index');
});
