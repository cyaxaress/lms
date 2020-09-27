<?php


namespace App;


use Cyaxaress\Media\Contracts\FileServiceContract;
use Cyaxaress\Media\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ZipFileService implements FileServiceContract
{
    public static function upload(UploadedFile $file, $filename, $dir) :array
    {
        Storage::putFileAs( $dir , $file, $filename . '.' . $file->getClientOriginalExtension());
        return ["zip" => $dir . $filename .  '.' . $file->getClientOriginalExtension()];
    }

    public static function delete(Media $media)
    {
        // TODO: Implement delete() method.
    }
}
