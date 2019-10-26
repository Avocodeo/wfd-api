<?php

namespace Tests\Feature;

use App\Ingredient;
use App\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IngredientsTest extends TestCase
{
    // Fake data, and dump / migrate databases each time
    use WithFaker, RefreshDatabase;

    public function testCanCreateIngredient()
    {
        // $this->withoutExceptionHandling(); 

        $attributes = [
            'name' => $this->faker->name,
            'cost' => $this->faker->randomFloat(2, 0, 10),
            'supplier_id' => factory(Supplier::class)->create()->id,
        ];

        $this->post('api/ingredients', $attributes);
        $this->assertDatabaseHas('ingredients', $attributes);
    }

    public function testCanViewIngredients()
    {
        $this->withoutExceptionHandling();
        factory(Ingredient::class)->create();

        $this->get("/api/ingredients")
            ->assertStatus(200);
    }

    public function testCanViewIngredient()
    {
        $this->withoutExceptionHandling();

        $ingredient = factory(Ingredient::class)->create();

        $this->get("/api/ingredients/$ingredient->id")
            ->assertStatus(200);
    }


    public function testCanUpdateIngredient()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'name' => 'salt',
            'cost' => '2'
        ];

        $ingredient = factory(Ingredient::class)->create();

        $this->patch("/api/ingredients/$ingredient->id", $attributes);

        $this->assertDatabaseHas('ingredients', ['name' => 'salt']);
    }

    public function testCanDeleteIngredient()
    {
        $ingredient = factory(Ingredient::class)->create();

        $this->delete("/api/ingredients/$ingredient->id");

        $this->assertDatabaseMissing('ingredients', ['id' => $ingredient->id]);
    }
}
