<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

declare(strict_types=1);

Route::group([
    'middleware' => 'auth:api',

], static function () {
    Route::apiResource('users', \App\Http\Controllers\User\UserController::class);
});
