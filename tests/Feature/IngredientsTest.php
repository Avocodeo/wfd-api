<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IngredientsTest extends TestCase
{
    // Fake data, and dump / migrate databases each time
    use WithFaker, RefreshDatabase;

    public function testCanCreateIngredient()
    {
        $this->withoutExceptionHandling(); // when exceptions are thrown laravel catches them but we want the exception

        $attributes = [
            'name' => $this->faker->name,
            'measurement_id' => $this->faker->numberBetween(1, 5),
        ];

        $this->get('/ingredients/create')->assertStatus(200); // they can access a create page
        $this->post('api/ingredients', $attributes);
        $this->assertDatabaseHas('ingredients', $attributes);
    }
}
