<?php


namespace Cyaxaress\Media\Contracts;


use Cyaxaress\Media\Models\Media;
use Illuminate\Http\UploadedFile;

interface FileServiceContract
{
    public static function upload(UploadedFile $file, string $filename, string $dir) :array ;

    public static function delete(Media $media);

    public static function thumb(Media $media);

    public static function stream(Media $media);
}
