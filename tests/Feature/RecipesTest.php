<?php

namespace Tests\Feature;

use App\Category;
use App\Recipe;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecipesTest extends TestCase
{
    // Fake data, and dump / migrate databases each time
    use WithFaker, RefreshDatabase;

    public function testCanCreateRecipe()
    {
        $this->withoutExceptionHandling(); // when exceptions are thrown laravel catches them but we want the exception

        $attributes = [
            'name' => $this->faker->name,
            'category_id' => factory(Category::class)->create()->id,
        ];

        $this->post('api/recipes', $attributes);
        $this->assertDatabaseHas('recipes', $attributes);
    }

    public function testCanViewRecipes()
    {
        $this->withoutExceptionHandling();
        factory(Recipe::class)->create();

        $this->get("/api/recipes")
            ->assertStatus(200);
    }

    public function testCanViewRecipe()
    {
        $this->withoutExceptionHandling();

        $recipe = factory(Recipe::class)->create();

        $this->get("/api/recipes/$recipe->id")
            ->assertStatus(200);
    }


    public function testCanUpdateRecipe()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'name' => 'Butter Chicken',
        ];

        $recipe = factory(Recipe::class)->create();

        $this->patch("/api/recipes/$recipe->id", $attributes);

        $this->assertDatabaseHas('recipes', ['name' => 'Butter Chicken']);
    }

    public function testCanDeleteRecipe()
    {
        $recipe = factory(Recipe::class)->create();

        $this->delete("/api/recipes/$recipe->id");

        $this->assertDatabaseMissing('recipes', ['id' => $recipe->id]);
    }
}
