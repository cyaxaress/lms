<?php

namespace Cyaxaress\Course\Tests\Feature;

use Cyaxaress\Category\Models\Category;
use Cyaxaress\Comment\Models\Comment;
use Cyaxaress\Course\Models\Course;
use Cyaxaress\RolePermissions\Database\Seeds\RolePermissionTableSeeder;
use Cyaxaress\RolePermissions\Models\Permission;
use Cyaxaress\User\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use DatabaseMigrations;
    use WithFaker;

    // permitted user can see curses index
    public function test_permitted_user_can_see_comments_index()
    {
        $this->actAsAdmin();
        $this->get(route('comments.index'))->assertOk();

        $this->actionAsSuperAdmin();
        $this->get(route('comments.index'))->assertOk();
    }

    public function test_normal_user_can_not_see_courses_index()
    {
        $this->actAsUser();
        $this->get(route('comments.index'))->assertStatus(403);
    }

    // permitted user can create course
    public function test_user_can_store_comment()
    {
        $this->actAsUser();
        $course = $this->createCourse();
        $this->post(route('comments.store', [
            'body' => 'my first test comment',
            'commentable_id' => $course->id,
            'commentable_type' => get_class($course),
        ]))->assertRedirect();

        $this->assertEquals(1, Comment::query()->count());
    }

    public function test_user_can_not_reply_to_unapproved_comment()
    {
        $this->actAsUser();
        $course = $this->createCourse();
        $this->post(route('comments.store', [
            'body' => 'my first test comment',
            'commentable_id' => $course->id,
            'commentable_type' => get_class($course),
        ]));
        $this->post(route('comments.store', [
            'body' => 'my first test comment',
            'commentable_id' => $course->id,
            'comment_id' => 1,
            'commentable_type' => get_class($course),
        ]));
        $this->assertEquals(1, Comment::query()->count());
    }

    public function test_user_can_reply_to_approved_comment()
    {
        $this->actAsAdmin();
        $course = $this->createCourse();
        $this->post(route('comments.store', [
            'body' => 'my first test comment',
            'commentable_id' => $course->id,
            'commentable_type' => get_class($course),
        ]));
        $this->post(route('comments.store', [
            'body' => 'my first test comment',
            'commentable_id' => $course->id,
            'comment_id' => 1,
            'commentable_type' => get_class($course),
        ]));
        $this->assertEquals(2, Comment::query()->count());
    }

    private function createUser()
    {
        $this->actingAs(User::factory()->create());
        $this->seed(RolePermissionTableSeeder::class);
    }

    private function actAsUser()
    {
        $this->createUser();
    }

    private function actAsAdmin()
    {
        $this->createUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_COMMENTS);
    }

    private function actionAsSuperAdmin()
    {
        $this->createUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_SUPER_ADMIN);
    }

    private function createCourse()
    {
        $data = $this->courseData() + ['confirmation_status' => Course::CONFIRMATION_STATUS_PENDING];
        unset($data['image']);

        return Course::create($data);
    }

    private function createCategory()
    {
        return Category::create(['title' => $this->faker->word, 'slug' => $this->faker->word]);
    }

    private function courseData()
    {
        $category = $this->createCategory();

        return [
            'title' => $this->faker->sentence(2),
            'slug' => $this->faker->sentence(2),
            'teacher_id' => auth()->id(),
            'category_id' => $category->id,
            'priority' => 12,
            'price' => 1200,
            'percent' => 70,
            'type' => Course::TYPE_FREE,
            'image' => UploadedFile::fake()->image('banner.jpg'),
            'status' => Course::STATUS_COMPLETED,
        ];
    }
}
