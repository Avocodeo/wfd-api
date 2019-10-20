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

        $this->get('/Measurements/create')->assertStatus(200);
        $this->post('api/Measurements', $attributes);
        $this->assertDatabaseHas('Measurements', $attributes);
    }

    public function testCanViewMeasurements()
    {
        $this->withoutExceptionHandling();
        factory(Measurement::class)->create();

        $this->get("/api/Measurements")
            ->assertStatus(200);
    }

    public function testCanViewMeasurement()
    {
        $this->withoutExceptionHandling();

        $measurement = factory(Measurement::class)->create();

        $this->get("/api/Measurements/$measurement->id")
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

        $this->patch("/api/Measurements/$measurement->id", $attributes);

        $this->assertDatabaseHas('Measurements', ['name' => 'Pounds']);
    }

    public function testCanDeleteMeasurement()
    {
        $measurement = factory(Measurement::class)->create();

        $this->delete("/api/Measurements/$measurement->id");

        $this->assertDatabaseMissing('Measurements', ['id' => $measurement->id]);
    }

}
