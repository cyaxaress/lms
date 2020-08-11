<?php

namespace Cyaxaress\Course\Tests\Feature;

use Cyaxaress\Category\Models\Category;
use Cyaxaress\Course\Database\Seeds\RolePermissionTableSeeder;
use Cyaxaress\Course\Models\Course;
use Cyaxaress\RolePermissions\Models\Permission;
use Cyaxaress\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    // permitted user can see curses index
    public function test_permitted_user_can_see_courses_index()
    {
        $this->actAsAdmin();
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
        $this->actAsAdmin();
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

    // permitted user can store course
    public function test_permitted_user_can_store_course()
    {
        $this->actAsUser();
        auth()->user()->givePermissionTo([Permission::PERMISSION_MANAGE_OWN_COURSES, Permission::PERMISSION_TEACH]);
        Storage::fake('local');
        $response = $this->post(route('courses.store'), $this->courseData());
        $response->assertRedirect(route('courses.index'));
        $this->assertEquals(Course::count(), 1);
    }

    // permitted user can edit course
    public function test_permitted_user_can_edit_course()
    {
        $this->actAsAdmin();
        $course = $this->createCourse();
        $this->get(route('courses.edit', $course->id))->assertOk();

        $this->actAsUser();
        $course = $this->createCourse();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
        $this->get(route('courses.edit', $course->id))->assertOk();
    }

    public function test_permitted_user_can_not_edit_other_users_courses()
    {
        $this->actAsUser();
        $course = $this->createCourse();
        $this->actAsUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
        $this->get(route('courses.edit', $course->id))->assertStatus(403);
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

    private function actAsUser()
    {
        $this->createUser();
    }

    private function actAsAdmin()
    {
        $this->createUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_COURSES);
    }

    private function actionAsSuperAdmin()
    {
        $this->createUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_COURSES);
    }

    private function createCourse()
    {
        $data = $this->courseData() + ['confirmation_status' => Course::CONFIRMATION_STATUS_PENDING,];
        unset($data['image']);
        return Course::create($data);
    }

    private function createCategory()
    {
        return Category::create(['title' => $this->faker->word, "slug" => $this->faker->word]);
    }

    private function courseData()
    {
        $category = $this->createCategory();
        return[
            'title' => $this->faker->sentence(2),
            "slug" => $this->faker->sentence(2),
            'teacher_id' => auth()->id(),
            'category_id' => $category->id,
            "priority" => 12,
            "price" => 1200,
            "percent" => 70,
            "type" => Course::TYPE_FREE,
            "image" => UploadedFile::fake()->image('banner.jpg'),
            "status" => Course::STATUS_COMPLETED,
        ];
    }
}
