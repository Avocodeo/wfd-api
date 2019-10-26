<?php

use Illuminate\Database\Seeder;
use App\Measurement;
use App\MeasurementType;

class MeasurementsTableSeeder extends Seeder
{
    public function run()
    {
        factory(Measurement::class, 5)->create();
    }
}
