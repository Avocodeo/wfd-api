<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\User;
use Tests\TestCase;
// use Illuminate\Support\Str;


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

    public function testCanDeleteUser()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        $this->delete("/api/users/$user->id");

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
