<?php



namespace App;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageUtility
{
    public static function storeImage($image, $path, $width, $height)
    {

        $extension = ImageUtility::getExtension($image);
        $randomStr = Str::random(40);
        $image = Image::make($image);

        $directory = public_path() . $path;
        $ImageStr = $directory . $randomStr . $extension;
        $image->resize($width, $height);
        $image->save($ImageStr);
        return $path . $randomStr . $extension;
    }

    public static function getExtension($image)
    {
        $array = explode('.', $image->getClientOriginalName());
        return '.' . $array[sizeof($array) - 1];
    }
    public static function deleteImage($image)
    {
        //        dd($image);
        $imageDirectory = public_path($image);
        if (file_exists($imageDirectory))
            unlink($imageDirectory);
    }
}
