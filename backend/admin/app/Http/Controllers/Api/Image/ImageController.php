<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Image;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

// TODO export yo action or services
class ImageController extends Controller
{
    /**
     * Upload new image
     *
     * @param Request $request
     * @return string[]
     */
    public function upload(Request $request): array
    {
        $file = $request->file('image');
        $name = Str::random(10);
        $url = Storage::putFileAs('images', $file, $name . '.' . $file->extension());

        return [
            'url' => env('APP_URL') . '/' . $url,
        ];
    }
}
