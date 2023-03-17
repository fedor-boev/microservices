<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Check AUTH user is authenticated
     *
     * @return int
     */
    public function authenticated(): int
    {
        return 1;
    }
}
