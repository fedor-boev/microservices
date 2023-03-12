<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Dashboard\DashboardController;
use App\Http\Controllers\Api\Image\ImageController;
use App\Http\Controllers\Api\Order\OrderController;
use App\Http\Controllers\Api\Permission\PermissionController;
use App\Http\Controllers\Api\Product\ProductController;
use App\Http\Controllers\Api\Role\RoleController;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', static fn() => 'API admin');

Route::get('user', [AuthController::class, 'user']);

// Admin
Route::group([
    'middleware' => 'scope.admin',
], static function () {
    Route::get('chart', [DashboardController::class, 'chart']);
    Route::post('upload', [ImageController::class, 'upload']);
    Route::get('export', [OrderController::class, 'export']);

    Route::apiResource('users', UserController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('orders', OrderController::class)->only('index', 'show');
    Route::apiResource('permissions', PermissionController::class)->only('index');
});

Route::fallback(static function () {
    return redirect('api');
});
