<?php

use Illuminate\Database\Seeder;
use App\Notifications;

class NotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(Notifications::class, 5)->create();
    }
}
