<?php

use Illuminate\Database\Seeder;
use App\MeasurementType;

class MeasurementTypesTableSeeder extends Seeder
{
    public function run()
    {
        factory(MeasurementType::class, 5)->create();
    }
}
