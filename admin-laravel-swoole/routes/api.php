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

/**
 * Group Modules
 */

// Helper
Route::get('/', static function () {
    return 'API is working!';
});

// Auth
Route::controller(\App\Http\Controllers\Api\V1\Auth\AuthController::class)->group(function () {
    Route::post('login', 'login')->name('login');
    Route::post('register', 'register')->name('register');
});

Route::group([
    'middleware' => ['auth:api'],
], static function () {
    Route::controller(\App\Http\Controllers\Api\V1\Auth\AuthController::class)->group(function () {
        Route::get('user', 'user');
        Route::put('users/info', 'updateInfo');
        Route::put('users/password', 'updatePassword');
    });
});

// Admin
Route::group([
    'middleware' => ['auth:api'],
    'prefix' => 'admin',
], static function () {
    Route::get('export', [\App\Http\Controllers\Api\V1\Admin\OrderController::class, 'export']);
    Route::get('chart', [\App\Http\Controllers\Api\V1\Admin\DashboardController::class, 'chart']);
    Route::post('upload', [\App\Http\Controllers\Api\V1\Admin\ImageController::class, 'upload']);

    Route::apiResource('users', \App\Http\Controllers\Api\V1\Admin\UserController::class);
    Route::apiResource('roles', \App\Http\Controllers\Api\V1\Admin\RoleController::class);
    Route::apiResource('products', \App\Http\Controllers\Api\V1\Admin\ProductController::class);
    Route::apiResource('orders', \App\Http\Controllers\Api\V1\Admin\OrderController::class)->only('index', 'show');
    Route::apiResource('permissions', \App\Http\Controllers\Api\V1\Admin\PermissionController::class)->only('index');
});

// Influencer
Route::group([
    'middleware' => ['auth:api'],
    'prefix' => 'influencer',
], static function () {
    Route::get('products', [\App\Http\Controllers\Api\V1\Influencer\ProductController::class, 'index']);
});
