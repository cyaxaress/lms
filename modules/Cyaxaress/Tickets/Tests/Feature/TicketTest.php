<?php

namespace Cyaxaress\Ticket\Tests\Feature;

use Cyaxaress\RolePermissions\Database\Seeds\RolePermissionTableSeeder;
use Cyaxaress\RolePermissions\Models\Permission;
use Cyaxaress\Ticket\Models\Ticket;
use Cyaxaress\User\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TicketTest extends TestCase
{
    use DatabaseMigrations;
    use WithFaker;

    public function test_user_can_see_tickets()
    {
        $this->actionAsUser();
        $this->get(route('tickets.index'))->assertOk();
    }

    public function test_user_can_see_create_tickets()
    {
        $this->actionAsUser();
        $this->get(route('tickets.create'))->assertOk();
    }

    public function test_user_can_store_ticket()
    {
        $this->actionAsUser();
        $this->createTicket();
        $this->assertEquals(1, Ticket::all()->count());
    }

    public function test_permitted_user_can_delete_ticket()
    {
        $this->actionAsAdmin();
        $this->createTicket();
        $this->assertEquals(1, Ticket::all()->count());

        $this->delete(route('tickets.destroy', 1))->assertOk();
    }

    public function test_user_can_not_delete_ticket()
    {
        $this->actionAsUser();
        $this->createTicket();
        $this->assertEquals(1, Ticket::all()->count());

        $this->delete(route('tickets.destroy', 1))->assertStatus(403);
    }

    private function actionAsAdmin()
    {
        $this->actingAs(User::factory()->create());
        $this->seed(RolePermissionTableSeeder::class);
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_TICKETS);
    }

    private function actionAsUser()
    {
        $this->actingAs(User::factory()->create());
        $this->seed(RolePermissionTableSeeder::class);
    }

    private function createTicket()
    {
        return $this->post(route('tickets.store'), ['title' => $this->faker->word, 'body' => $this->faker->text]);
    }
}
