<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Permission;

use App\Http\Controllers\Controller;
use App\Http\Resources\Permission\PermissionResource;
use App\Models\Permission\Permission;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Resource api (index)
 */
class PermissionController extends Controller
{
    /**
     * Get all permissions
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return PermissionResource::collection(Permission::all());
    }
}
