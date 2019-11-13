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
        factory(User::class)->create(['name' => 'admin', 'isAdmin' => '1', 'email' => 'admin@uwindsor.ca']);
        factory(User::class, 20)->create();
    }
}
