<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Influencer;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class InfluencerController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
