<?php
namespace Cyaxaress\Media\Services;


use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageFileService
{
    protected static $sizes = ['300', '600'];

    public static function upload($file)
    {
        $filename = uniqid();
        $extension = $file->getClientOriginalExtension();
        $dir = 'public\\';
        Storage::putFileAs( $dir , $file, $filename . '.' . $extension);

        $path = $dir . $filename .  '.' . $extension;

        return self::resize(Storage::path($path), $dir, $filename, $extension);
    }

    private static function resize($img, $dir, $filename, $extension)
    {
        $img = Image::make($img);
        $imgs['original'] =  $filename . '.' . $extension;
        foreach (self::$sizes as $size) {
            $imgs[$size] = $filename . '_'. $size. '.' . $extension;
            $img->resize($size, null, function ($aspect) {
                $aspect->aspectRatio();
            })->save(Storage::path($dir) . $filename . '_'. $size. '.' . $extension);
        }
        return $imgs;
    }

    public static function delete($media)
    {
        foreach ($media->files as $file) {
            Storage::delete('public\\' . $file);
        }
    }
}
