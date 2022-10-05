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
use App\Models\User;

Route::get('/', static function () {

//    \DB::enableQueryLog();

    $user = User::query()->select(['id'])->first();

    for ($i = 1; $i <= 1; $i++) {
        \App\Jobs\UserInfo::dispatch($user)
            // берется из config queue connections
            ->onConnection('redis')
            // берется из queue
//        ->onQueue('user')
        ;
    }


//    \App\Jobs\UserInfo::dispatch($user)
//        ->onConnection('redis')
//        ->onQueue('user_2');
//    dispatch(new \App\Jobs\UserInfo($user));

//    dd(\DB::getQueryLog());

//    Log::critical("This is an critical level message.");
//    Log::emergency("This is an emergency level message.");

    return 'API is working!';
});

Route::get('test', static function(\Illuminate\Http\Request $request) {
    return Blade::render('{{ $greeting }}, @if (true) World @else Folks @endif', ['greeting' => 'Hello']);
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->name('login');
    Route::post('register', 'register')->name('register');
});

// Admin
Route::group([
    'middleware' => ['auth:api'], // Unauthenticated if header Accept application/json
    'prefix' => 'admin',
], static function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('user', 'user');
        Route::put('users/info', 'updateInfo');
        Route::put('users/password', 'updatePassword');
    });

    Route::post('upload', [ImageController::class, 'upload']);
    Route::get('export', [OrderController::class, 'export']);

    Route::get('chart', [DashboardController::class, 'chart']);

    Route::apiResource('users', UserController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('orders', OrderController::class)->only('index', 'show');
    Route::apiResource('permissions', PermissionController::class)->only('index');
});
