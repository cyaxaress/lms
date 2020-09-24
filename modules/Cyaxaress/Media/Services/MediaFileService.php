<?php

namespace Cyaxaress\Media\Services;

use Cyaxaress\Media\Models\Media;

class MediaFileService
{
    public static function upload($file)
    {
        $extension = strtolower($file->getClientOriginalExtension());
        foreach (config('mediaFile.MediaTypeServices') as $key => $service) {
            if (in_array($extension, $service['extensions'])) {
                $media = new Media();
                $media->files = $service["handler"]::upload($file);
                $media->type = $key;
                $media->user_id = auth()->id();
                $media->filename = $file->getClientOriginalName();
                $media->save();
                return $media;
            }
        }
    }

    public static function delete($media)
    {
        switch ($media->type) {
            case 'image':
                ImageFileService::delete($media);
                break;
        }
    }
}
