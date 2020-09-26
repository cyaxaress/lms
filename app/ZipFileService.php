<?php


namespace App;


use Cyaxaress\Media\Contracts\FileServiceContract;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ZipFileService implements FileServiceContract
{
    public static function upload(UploadedFile $file) :array
    {
        $filename = uniqid();
        $extension = $file->getClientOriginalExtension();
        $dir = 'private\\';
        Storage::putFileAs( $dir , $file, $filename . '.' . $extension);

        return ["zip" => $dir . $filename .  '.' . $extension];
    }

    public static function delete()
    {
        // TODO: Implement delete() method.
    }
}
