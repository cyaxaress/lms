<?php


namespace Cyaxaress\Media\Services;


use Cyaxaress\Media\Models\Media;
use Illuminate\Support\Facades\Storage;

class DefaultFileService
{
    public static $media;

    public static function delete($media)
    {
        foreach ($media->files as $file) {
            if ($media->is_private) {
                Storage::delete('private\\' . $file);
            } else {
                Storage::delete('public\\' . $file);
            }
        }
    }

    public static function getFilename()
    {
        return (static::$media->is_private ? 'private/' : 'public/') . static::$media->files['video'];
    }

    public static function stream(Media $media)
    {
        static::$media = $media;
        $stream = Storage::readStream(static::getFilename());
        return response()->stream(function () use ($stream) {
            fpassthru($stream);
        },
            200,
            [
                "Content-Type" => Storage::mimeType(static::getFilename()),
                "Content-disposition" => "attachment; filename='" . static::$media->filename ."'"
            ]
        );
    }
}
