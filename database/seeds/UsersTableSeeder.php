<?php

use Illuminate\Database\Seeder;
// use Illuminate\Foundation\Auth\User;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Admin',
            'isAdmin' => true,
            'email' => 'admin@uwindsor.ca',
            'email_verified_at' => now(),
            'password' =>  bcrypt('admin'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        factory(User::class, 50)->create();
    }
}
