<?php

declare(strict_types=1);

Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('register', [\App\Http\Controllers\Auth\RegisterController::class, 'register']);

Route::group([
    'middleware' => 'auth:api',
], static function () {
    Route::get('user', [\App\Http\Controllers\Auth\User\UserController::class, 'user']);
    Route::patch('users/info', [\App\Http\Controllers\Auth\User\UpdateUserInfoController::class, 'updateInfo']);
    Route::patch('users/password', [\App\Http\Controllers\Auth\User\UpdatePasswordController::class, 'updatePassword']);

    Route::get('admin', [\App\Http\Controllers\Auth\AuthController::class, 'authenticated'])->middleware('scope:admin');
    Route::get('influencer', [\App\Http\Controllers\Auth\AuthController::class, 'authenticated'])->middleware('scope:influencer');
});

