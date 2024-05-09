<?php

namespace Cyaxaress\Category\Models;

use Cyaxaress\Category\Database\Factories\CategoryFactory;
use Cyaxaress\Course\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public static function newFactory()
    {
        return CategoryFactory::new();
    }

    protected $guarded = [];

    public function getParentAttribute()
    {
        return (is_null($this->parent_id)) ? 'ندارند' : $this->parentCategory->title;
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function path()
    {
        return route('categories.show', $this->id);
    }
}
