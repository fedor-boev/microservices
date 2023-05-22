<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use Controller;

class AuthController extends Controller
{
    /**
     * User is authenticated
     *
     * @return int
     */
    public function authenticated(): int
    {
        return 1;
    }
}
