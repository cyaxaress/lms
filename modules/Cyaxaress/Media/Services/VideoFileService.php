<?php
namespace Cyaxaress\Media\Services;


use Illuminate\Support\Facades\Storage;

class VideoFileService
{
    public static function upload($file)
    {
        $filename = uniqid();
        $extension = $file->getClientOriginalExtension();
        $dir = 'private\\';
        Storage::putFileAs( $dir , $file, $filename . '.' . $extension);

        return ["video" => $dir . $filename .  '.' . $extension];
    }
}
