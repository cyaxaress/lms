<?php

namespace Alikeshtkar\Tag\Models;

use Alikeshtkar\Tag\Database\Factories\TagFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Cyaxaress\Course\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [];

    protected static function newFactory()
    {
        return TagFactory::new();
    }

    public function courses()
    {
        return $this->morphedByMany(Course::class, 'taggable');
    }

    public function path(): string
    {
        return route('tags.show', $this->slug);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
