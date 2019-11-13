<?php

use Illuminate\Database\Seeder;
use App\Measurement;

class MeasurementsTableSeeder extends Seeder
{
    public function run()
    {
        $ingredients = collect([
            ['name' => 'Gallons', 'abbreviation' => 'gal', 'type_id' => '1'],
            ['name' => 'Pounds', 'abbreviation' => 'lbs', 'type_id' => '2'],
            ['name' => 'Kilograms', 'abbreviation' => 'kg', 'type_id' => '3'],
            ['name' => 'Grams', 'abbreviation' => 'g', 'type_id' => '4'],
            ['name' => 'Liters', 'abbreviation' => 'l', 'type_id' => '5'],
            ['name' => 'Millimeters', 'abbreviation' => 'mm', 'type_id' => '6'],
            ['name' => 'Slice', 'abbreviation' => 'sl', 'type_id' => '7'],
        ]);

        $ingredients->each(function ($measurement) {
            Measurement::create($measurement);
        });
    }
}
