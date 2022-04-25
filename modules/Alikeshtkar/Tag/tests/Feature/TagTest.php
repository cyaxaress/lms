<?php

namespace Alikeshtkar\Tag\Tests\Feature;

use Alikeshtkar\Tag\Models\Tag;
use Cyaxaress\RolePermissions\Database\Seeds\RolePermissionTableSeeder;
use Cyaxaress\RolePermissions\Models\Permission;
use Cyaxaress\RolePermissions\Models\Role;
use Cyaxaress\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testNormaUserCanNotSeeTagsIndex()
    {
        $this->get(route('tags.index'))->assertRedirect(route('login'));
        $this->_generateAndAuthenticateUser();
        $this->get(route('tags.index'))->assertForbidden();
    }

    public function testPermittedUserCanSetTagsIndex()
    {
        $this->_generateAndAuthenticateUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_TAGS);
        $this->get(route('tags.index'))->assertOk();
        $this->actingAs(User::factory()->create());
        auth()->user()->assignRole(Role::ROLE_SUPER_ADMIN);
        $this->get(route('tags.index'))->assertOk();
    }

    public function testNormaUserCanNotStoreTag()
    {
        $this->post(route('tags.store'), ['title' => $this->faker->sentence()])->assertRedirect(route('login'));
        $this->_generateAndAuthenticateUser();
        $this->post(route('tags.store'), ['title' => $this->faker->sentence()])->assertForbidden();
    }

    public function testPermittedUserCanStoreTag()
    {
        $this->_generateAndAuthenticateUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_TAGS);
        $this->assertDatabaseCount(Tag::class, 0)
            ->post(route('tags.store'), ['title' => $this->faker->sentence()])
            ->assertRedirect(route('tags.index'));
        $this->assertDatabaseCount(Tag::class, 1);
        $this->actingAs(User::factory()->create());
        auth()->user()->assignRole(Role::ROLE_SUPER_ADMIN);
        $this->assertDatabaseCount(Tag::class, 1)
            ->post(route('tags.store'), ['title' => $this->faker->sentence()])
            ->assertRedirect(route('tags.index'));
        $this->assertDatabaseCount(Tag::class, 2);
    }

    public function testPermittedUserCanNotDuplicateTitleTag()
    {
        $tag = Tag::factory()->create();
        $this->_generateAndAuthenticateUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_TAGS);
        $this->assertDatabaseHas(Tag::class, ['title' => $tag->title])
            ->post(route('tags.store'), ['title' => $tag->title])
            ->assertRedirect()
            ->assertSessionHasErrors('title');
    }

    public function testNormaUserCanNotEditTag()
    {
        Tag::factory()->create();
        $this->get(route('tags.edit', 1), ['title' => $this->faker->sentence()])->assertRedirect(route('login'));
        $this->_generateAndAuthenticateUser();
        $this->get(route('tags.edit', 1), ['title' => $this->faker->sentence()])->assertForbidden();
    }

    public function testPermittedUserCanEditTag()
    {
        Tag::factory()->create();
        $this->_generateAndAuthenticateUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_TAGS);
        $this->get(route('tags.edit', 1))->assertOk();
        $this->actingAs(User::factory()->create());
        auth()->user()->assignRole(Role::ROLE_SUPER_ADMIN);
        $this->get(route('tags.edit', 1))->assertOk();
    }

    public function testNormaUserCanNotUpdateTag()
    {
        Tag::factory()->create();
        $title = $this->faker->sentence();
        $this->assertDatabaseMissing(Tag::class, ['title' => $title])
            ->patch(route('tags.update', 1), ['title' => $title])
            ->assertRedirect(route('login'));
        $this->assertDatabaseMissing(Tag::class, ['title' => $title]);
        $this->_generateAndAuthenticateUser();
        $this->assertDatabaseMissing(Tag::class, ['title' => $title])
            ->patch(route('tags.update', 1), ['title' => $title])
            ->assertForbidden();
        $this->assertDatabaseMissing(Tag::class, ['title' => $title]);
    }

    public function testPermittedUserCanUpdateTag()
    {
        $this->_generateAndAuthenticateUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_TAGS);
        Tag::factory()->create();
        $title = $this->faker->sentence();
        $this->assertDatabaseMissing(Tag::class, ['title' => $title])
            ->patch(route('tags.update', 1), ['title' => $title])
            ->assertRedirect(route('tags.index'));
        $this->assertDatabaseHas(Tag::class, ['title' => $title]);
        $this->actingAs(User::factory()->create());
        auth()->user()->assignRole(Role::ROLE_SUPER_ADMIN);
        $title = $this->faker->sentence();
        $this->assertDatabaseMissing(Tag::class, ['title' => $title])
            ->patch(route('tags.update', 1), ['title' => $title])
            ->assertRedirect(route('tags.index'));
        $this->assertDatabaseHas(Tag::class, ['title' => $title]);
    }

    public function testNormaUserCanNotDestroyTag()
    {
        Tag::factory()->create();
        $this->delete(route('tags.destroy', 1))->assertRedirect(route('login'));
        $this->_generateAndAuthenticateUser();
        $this->delete(route('tags.destroy', 1))->assertForbidden();
    }

    public function testPermittedUserCanDestroyTag()
    {
        $this->_generateAndAuthenticateUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_TAGS);
        Tag::factory()->count(2)->create();
        $this->assertDatabaseCount(Tag::class, 2)
            ->delete(route('tags.destroy', 1))
            ->assertOk();
        $this->assertDatabaseCount(Tag::class, 1)
            ->actingAs(User::factory()->create());
        auth()->user()->assignRole(Role::ROLE_SUPER_ADMIN);
        $this->delete(route('tags.destroy', 2))->assertOk();
        $this->assertDatabaseCount(Tag::class, 0);
    }

    public function _generateAndAuthenticateUser()
    {
        $this->seed(RolePermissionTableSeeder::class);
        $this->assertDatabaseCount(User::class, 0);
        $this->actingAs(User::factory()->create())
            ->assertAuthenticated()
            ->assertDatabaseCount(User::class, 1);
    }
}
