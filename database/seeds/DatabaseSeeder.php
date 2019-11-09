<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MeasurementsTableSeeder::class);
        $this->call(IngredientsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(RecipesTableSeeder::class);
        $this->call(MeasurementTypesTableSeeder::class);
        $this->call(InventoriesTableSeeder::class);
        $this->call(SuppliersTableSeeder::class);
        $this->call(NotificationsTableSeeder::class);
    }
}
