<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Auth\User;
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

    public function testCanCreateUser()
    {
        $this->withoutExceptionHandling();

        // $attributes = [
        //     'type_id' => $this->faker->numberBetween(1, 5),
        //     'name' => $this->faker->name,
        //     'abbreviation' => $this->faker->randomLetter,
        // ];
        $attributes = [
            'name' => $this->faker->name,
            // 'email' => $this->faker->unique()->safeEmail,
            // 'email_verified_at' => now(),
            // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            // 'remember_token' => Str::random(10),
        ];

        $this->get('/users/create')->assertStatus(200);
        $this->post('api/users', $attributes);
        $this->assertDatabaseHas('users', $attributes);
    }

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

    // public function testCanUpdateUser()
    // {
    //     $this->withoutExceptionHandling();

    //     $attributes = [
    //         'name' => 'test',
    //         'email' => 'testEmail',
    //         'password' => '$TESTpassw0rd',
    //     ];

    //     $user = factory(User::class)->create();

    //     $this->patch("/api/users/$user->name", $attributes);

    //     $this->assertDatabaseHas('users', ['name' => 'test']);
    // }

    public function testCanDeleteUser()
    {
        $user = factory(User::class)->create();

        $this->delete("/api/users/$user->id");

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
