<?php


namespace Cyaxaress\Media\Services;


use Illuminate\Support\Facades\Storage;

class DefaultFileService
{
    public static function delete($media)
    {
        foreach ($media->files as $file) {
            if ($media->is_private) {
                Storage::delete('private\\' . $file);
            }else{
                Storage::delete('public\\' . $file);
            }
        }
    }
}
