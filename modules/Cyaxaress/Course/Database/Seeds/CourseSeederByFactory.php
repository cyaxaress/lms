<?php

namespace Cyaxaress\Course\Database\Seeds;

use Cyaxaress\Category\Models\Category;
use Cyaxaress\Course\Models\Course;
use Cyaxaress\Media\Models\Media;
use Cyaxaress\RolePermissions\Models\Role;
use Cyaxaress\User\Models\User;
use Illuminate\Database\Seeder;

class CourseSeederByFactory extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::factory(5)
            ->has(
                Course::factory(3)
                    ->for(Category::factory())
                    ->for(Media::factory(), 'banner')

            )
            ->create()->each(function (User $user) {
                $user->assignRole(Role::ROLE_TEACHER);
            });
    }
}
