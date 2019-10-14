<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Auth\User;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testCanViewUsers()
    {
        $this->withoutExceptionHandling();

        factory(User::class)->create();

        $this->get("/api/users")
            ->assertStatus(200);
    }

    public function testCanViewUser()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $this->get("/api/users/$user->id")
            ->assertStatus(200);
    }
}
