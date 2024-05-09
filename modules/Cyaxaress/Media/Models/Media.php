<?php

namespace Cyaxaress\Media\Models;

use Cyaxaress\Media\Database\Factories\MediaFactory;
use Cyaxaress\Media\Services\MediaFileService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $casts = [
        'files' => 'json',
    ];

    public static function newFactory()
    {
        return MediaFactory::new();
    }

    protected static function booted()
    {
        static::deleting(function ($media) {
            MediaFileService::delete($media);
        });
    }

    public function getThumbAttribute()
    {
        return MediaFileService::thumb($this);
    }

    public function getUrl($quality = 'original'): string
    {
        return '/storage/'.$this->files[$quality];
    }
}
