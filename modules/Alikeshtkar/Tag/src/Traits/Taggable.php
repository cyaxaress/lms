<?php

namespace Alikeshtkar\Tag\Traits;

use Alikeshtkar\Tag\Models\Tag;
use Alikeshtkar\Tag\Repositories\TagRepository;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Taggable
{
    public static function bootTaggable()
    {
        static::created(function ($model) {
            self::_syncCourseTags($model);
        });
        static::updated(function ($model) {
            self::_syncCourseTags($model);
        });
    }

    /**
     * @param $model
     * @return void
     */
    private static function _syncCourseTags($model): void
    {
        $model->tags()->sync(resolve(TagRepository::class)->insertGetIds(request(config('tag.key'),[])));
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
