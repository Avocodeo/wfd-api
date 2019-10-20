<?php

use Illuminate\Database\Seeder;
use App\MeasurementType;

class MeasurementTypesTableSeeder extends Seeder
{
    public function run()
    {
        $ingredients = collect([
            [ 'name' => 'Each'],
            [ 'name' => 'Volume'],
            [ 'name' => 'Length'],
            [ 'name' => 'Weight'],
        ]);

        $ingredients->each(function($measurementType) {
            MeasurementType::create($measurementType);
        });
    }
}