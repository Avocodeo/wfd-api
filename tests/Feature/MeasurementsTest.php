<?php

namespace Tests\Feature;

use App\Measurement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MeasurementsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function testCanCreateMeasurement()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'type_id' => $this->faker->numberBetween(1,5),
            'name' => $this->faker->name,
            'abbreviation' => $this->faker->randomLetter,
        ];

        $this->post('api/measurements', $attributes);
        $this->assertDatabaseHas('measurements', $attributes);
    }

    public function testCanViewMeasurements()
    {
        $this->withoutExceptionHandling();
        factory(Measurement::class)->create();

        $this->get("/api/measurements")
            ->assertStatus(200);
    }

    public function testCanViewMeasurement()
    {
        $this->withoutExceptionHandling();

        $measurement = factory(Measurement::class)->create();

        $this->get("/api/measurements/$measurement->id")
            ->assertStatus(200);
    }


    public function testCanUpdateMeasurement()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'type_id' => $this->faker->numberBetween(1,5),
            'name' => 'Pounds',
            'abbreviation' => 'lbs',
        ];

        $measurement = factory(Measurement::class)->create();

        $this->patch("/api/measurements/$measurement->id", $attributes);

        $this->assertDatabaseHas('measurements', ['name' => 'Pounds']);
    }

    public function testCanDeleteMeasurement()
    {
        $measurement = factory(Measurement::class)->create();

        $this->delete("/api/measurements/$measurement->id");

        $this->assertDatabaseMissing('measurements', ['id' => $measurement->id]);
    }

}
