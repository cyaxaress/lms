<?php

namespace Cyaxaress\Course\Tests\Feature;

use Cyaxaress\Course\Database\Seeds\RolePermissionTableSeeder;
use Cyaxaress\Course\Models\Course;
use Cyaxaress\RolePermissions\Models\Permission;
use Cyaxaress\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    // permitted user can see curses index
    public function test_permitted_user_can_see_courses_index()
    {
        $this->actionAsAdmin();
        $this->get(route('courses.index'))->assertOk();

        $this->actionAsSuperAdmin();
        $this->get(route('courses.index'))->assertOk();
    }
    public function test_normal_user_can_not_see_courses_index()
    {
        $this->actAsUser();
        $this->get(route('courses.index'))->assertStatus(403);
    }

    // permitted user can create course
    public function test_permitted_user_can_create_course()
    {
        $this->actionAsAdmin();
        $this->get(route('courses.create'))->assertOk();

        $this->actAsUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
        $this->get(route('courses.create'))->assertOk();
    }

    public function test_normal_user_can_not_create_course()
    {
        $this->actAsUser();
        $this->get(route('courses.create'))->assertStatus(403);
    }

    // todo permitted user can store course

    // permitted user can edit course
    public function test_permitted_user_can_edit_course()
    {
        $this->actionAsAdmin();
        $course = $this->createCourse();
        $this->get(route('courses.edit', $course->id))->assertOk();

        $this->actAsUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
        $this->get(route('courses.edit', $course->id))->assertOk();
    }

    public function test_normal_user_can_not_edit_course()
    {
        $this->actAsUser();
        $course = $this->createCourse();
        $this->get(route('courses.edit', $course->id))->assertStatus(403);
    }

    // permitted user can update course

    // permitted user can delete course

    // permitted user can accept course
    // permitted user can reject course
    // permitted user can lock course
    private function createUser()
    {
        $this->actingAs(factory(User::class)->create());
        $this->seed(RolePermissionTableSeeder::class);
    }
    private function actAsUser(){
        $this->createUser();
    }
    private function actionAsAdmin()
    {
        $this->createUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_COURSES);
    }
    private function actionAsSuperAdmin()
    {
        $this->createUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_COURSES);
    }

    private function createCourse(){
        return Course::create([
            'title' => $this->faker->word,
            'teacher_id' => auth()->id(),
            "slug" => $this->faker->word,
            "priority" => 12,
            "price" => 1200,
            "percent" => 70,
            "type" => Course::TYPE_FREE,
            "status" => Course::STATUS_COMPLETED,
            "confirmation_status" => Course::CONFIRMATION_STATUS_ACCEPTED,
        ]);
    }
}
