<?php


namespace Cyaxaress\Media\Contracts;


use Illuminate\Http\UploadedFile;

interface FileServiceContract
{
    public static function upload(UploadedFile $file) :array ;

    public static function delete();
}
