<?php

namespace Cyaxaress\Media\Database\Factories;

use Cyaxaress\Media\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class MediaFactory extends Factory
{
    protected $model = Media::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'files' => ['300' => '6617fce53cdd2_300.png', '600' => '6617fce53cdd2_600.png', 'original' => '6617fce53cdd2.png'],
            'type' => 'image',
            'filename' => 'hemn_courses.jpg',
            'is_private' => false,
        ];
    }
}
