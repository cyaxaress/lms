<?php


namespace Cyaxaress\Discount\Models;


use Cyaxaress\Course\Models\Course;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $guarded = [];
    protected $casts = [
        "expire_at" => "datetime"
    ];
    public function courses()
    {
        return $this->morphedByMany(Course::class, "discountale");
    }
}
