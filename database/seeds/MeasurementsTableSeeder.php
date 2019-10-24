<?php

use Illuminate\Database\Seeder;
use App\Measurement;
use App\MeasurementType;

class MeasurementsTableSeeder extends Seeder
{
    public function run()
    {
        // $ingredients = collect([
        //     [ 'name' => 'Gallons', 'abbreviation' => 'gal', 'type_id' => '2'],
        //     [ 'name' => 'Pounds', 'abbreviation' => 'lbs', 'type_id' => '4'],
        //     [ 'name' => 'Kilograms', 'abbreviation' => 'kg', 'type_id' => '4'],
        //     [ 'name' => 'Grams', 'abbreviation' => 'g', 'type_id' => '4'],
        //     [ 'name' => 'Liters', 'abbreviation' => 'l', 'type_id' => '2'],
        //     [ 'name' => 'Millimeters', 'abbreviation' => 'mm', 'type_id' => '2'],
        // ]);

        // $ingredients->each(function($measurement) {
        //     Measurement::create($measurement);
        // });

        factory(MeasurementType::class, 5)->create()->each(function ($measurementType) {
            $measurement = factory(Measurement::class)->make();
            $measurementType->measurement()->save($measurement);
        });
    }
}
