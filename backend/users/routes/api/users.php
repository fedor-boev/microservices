<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

declare(strict_types=1);

use App\Modules\User\Controller\UserController;

Route::group([
    'middleware' => 'auth:api',
], static function () {
    Route::apiResource('users', UserController::class);
});
