<?php

declare(strict_types=1);

Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('register', [\App\Http\Controllers\Auth\RegisterController::class, 'register']);

Route::group([
    'middleware' => 'auth:api',
], static function () {
    Route::get('user', [\App\Http\Controllers\Auth\UserController::class, 'user']);
    Route::put('users/info', [\App\Http\Controllers\Auth\UserInfoController::class, 'updateInfo']);
    Route::put('users/password', [\App\Http\Controllers\Auth\UpdatePasswordController::class, 'updatePassword']);

    Route::get('admin', [\App\Http\Controllers\Auth\AuthController::class, 'authenticated'])->middleware('scope:admin');
    Route::get('influencer', [\App\Http\Controllers\Auth\AuthController::class, 'authenticated'])->middleware('scope:influencer');
});

