<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    /**
     * @param Request $request
     * @return string[]
     */
    public function upload(Request $request): array
    {
        $file = $request->file('image');
        $name = Str::random(10);
        $url = \Storage::putFileAs('images', $file, $name . '.' . $file->extension());

        return [
            'url' => env('APP_URL') . '/' . $url,
        ];
    }
}
