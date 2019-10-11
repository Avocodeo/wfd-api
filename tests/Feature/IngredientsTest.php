<?php

namespace Tests\Feature;

use App\Ingredient;
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

    public function testCanViewIngredients()
    {
        $this->withoutExceptionHandling();
        $ingredient = factory(Ingredient::class)->create();

        $this->get("/api/ingredients")
            ->assertStatus(200);
    }

    public function testCanViewAnIngredient()
    {
        $this->withoutExceptionHandling();

        $ingredient = factory(Ingredient::class)->create();

        $this->get("/api/ingredients/$ingredient->id")
            ->assertStatus(200);
    }


    public function testCanUpdateAnIngredient()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'name' => 'salt',
            'measurement_id' => '2'
        ];

        $ingredient = factory(Ingredient::class)->create();

        $this->patch("/api/ingredients/$ingredient->id", $attributes);

        $this->assertDatabaseHas('ingredients', ['name' => 'salt']);
    }

    public function testCanDeleteAnIngredient()
    {
        $ingredient = factory(Ingredient::class)->create();

        $this->delete("/api/ingredients/$ingredient->id");

        $this->assertDatabaseMissing('ingredients', ['id' => $ingredient->id]);
    }


}
