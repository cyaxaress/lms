<?php

namespace Cyaxaress\Course\Database\Factories;

use Cyaxaress\Course\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class CourseFactory extends Factory
{
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'slug' => $this->faker->slug(4),
            'body' => $this->faker->text(),
            'price' => $this->faker->randomElement([300000, 450000, 850000, 1950000, 48900000]),
            'percent' => 60,
            'type' => $this->faker->randomElement(Course::$types),
            'status' => $this->faker->randomElement(Course::$statuses),
            'confirmation_status' => $this->faker->randomElement(Course::$confirmationStatuses),
        ];
    }
}
