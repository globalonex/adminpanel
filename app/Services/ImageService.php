<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Str;

class ImageService
{
    const PATH_MAIN = 'public/images';
    const PATH_PRODUCT_IMAGES = 'public/product_images';

    /**
     * Upload an image
     *
     * @param $file
     * @return string
     */
    public function uploadImage($file)
    {
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();

        Storage::putFileAs(SELF::PATH_PRODUCT_IMAGES, $file, $filename);

        return $filename;
    }

    /**
     * Update an image
     *
     * @param $file
     * @param $oldFilename
     * @return string
     */
    public function updateImage($file, $oldFilename)
    {
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();

        Storage::putFileAs(SELF::PATH_PRODUCT_IMAGES, $file, $filename);

        if ($oldFilename !== null) {
            Storage::delete(SELF::PATH_PRODUCT_IMAGES . $oldFilename);
        }

        return $filename;
    }
}