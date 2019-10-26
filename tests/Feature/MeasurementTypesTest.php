<?php

namespace Tests\Feature;

use App\MeasurementType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MeasurementTypesControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function testCanCreateMeasurementType()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'name' => $this->faker->name,
        ];

        $this->post('api/measurement_types', $attributes);
        $this->assertDatabaseHas('measurement_types', $attributes);
    }

    public function testCanViewMeasurementTypes()
    {
        factory(MeasurementType::class)->create();

        $this->get("/api/measurement_types")
            ->assertStatus(200);
    }

    public function testCanViewMeasurementType()
    {
        $measurementType = factory(MeasurementType::class)->create();

        $this->get("/api/measurement_types/$measurementType->id")
            ->assertStatus(200);
    }


    public function testCanUpdateMeasurementType()
    {
        $attributes = [
            'name' => 'Weight'
        ];

        $measurementType = factory(MeasurementType::class)->create();

        $this->patch("/api/measurement_types/$measurementType->id", $attributes);

        $this->assertDatabaseHas('measurement_types', ['name' => 'Weight']);
    }

    public function testCanDeleteMeasurementType()
    {
        $measurementType = factory(MeasurementType::class)->create();

        $this->delete("/api/measurement_types/$measurementType->id");

        $this->assertDatabaseMissing('measurement_types', ['id' => $measurementType->id]);
    }

}
