<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index(): array
    {
        return [
            'data' => Permission::all(),
        ];
    }
}
