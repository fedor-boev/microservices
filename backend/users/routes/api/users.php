<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

declare(strict_types=1);

use App\Http\Controllers\Api\User\UserController;

Route::group([
    'middleware' => 'auth:api',
], static function () {
    Route::apiResource('users', UserController::class);
});
