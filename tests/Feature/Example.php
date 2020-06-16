<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class Example extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function BasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
