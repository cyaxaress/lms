<?php

namespace Alikeshtkar\Tag\Database\Factories;

use Alikeshtkar\Tag\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    protected $model = Tag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->unique()->company,
            'slug'=>$this->faker->unique()->slug,
        ];
    }
}
