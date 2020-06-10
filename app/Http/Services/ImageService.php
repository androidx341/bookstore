<?php


namespace App\Http\Services;


use Intervention\Image\Facades\Image;

class ImageService
{
    /**
     * Gemerate path form new image
     *
     * @return string
     */
    public static function generateCoversPath(?string $imageName)
    {
        if (!$imageName) {
            $imageName = "cover-" . time() . ".png";
        }

        return public_path() . '/img/covers/' . $imageName;
    }
}
