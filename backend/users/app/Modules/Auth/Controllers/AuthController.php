<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

declare(strict_types=1);

namespace App\Modules\Auth\Controllers;

use App\Common\Controllers\Controller;

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
