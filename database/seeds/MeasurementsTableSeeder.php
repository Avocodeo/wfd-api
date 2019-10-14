<?php

use Illuminate\Database\Seeder;
use App\Measurement;

class MeasurementsTableSeeder extends Seeder
{
    public function run()
    {
        $ingredients = collect([
            [ 'name' => 'Gallons', 'abbreviation' => 'gal'],
            [ 'name' => 'Pounds', 'abbreviation' => 'lbs'],
            [ 'name' => 'Kilograms', 'abbreviation' => 'kg'],
            [ 'name' => 'Grams', 'abbreviation' => 'g'],
            [ 'name' => 'Liters', 'abbreviation' => 'l'],
            [ 'name' => 'Millimeters', 'abbreviation' => 'mm'],
        ]);

        $ingredients->each(function($measurement) {
            Measurement::create($measurement);
        });
    }
}