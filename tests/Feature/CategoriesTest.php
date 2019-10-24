<?php

namespace Tests\Feature;

use App\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriesTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function testCanCreateCategory()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'name' => $this->faker->name,
        ];

        $this->post('api/categories', $attributes);

        $this->assertDatabaseHas('categories', $attributes);
    }

    public function testCanViewCategories()
    {
        $this->withoutExceptionHandling();
        factory(Category::class)->create();

        $this->get("/api/categories")
            ->assertStatus(200);
    }

    public function testCanViewCategory()
    {
        $this->withoutExceptionHandling();

        $category = factory(Category::class)->create();

        $this->get("/api/categories/$category->id")
            ->assertStatus(200);
    }


    public function testCanUpdateCategory()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'name' => 'salt',
            'measurement_id' => '2'
        ];

        $category = factory(Category::class)->create();

        $this->patch("/api/categories/$category->id", $attributes);

        $this->assertDatabaseHas('categories', ['name' => 'salt']);
    }

    public function testCanDeleteCategory()
    {
        $category = factory(Category::class)->create();

        $this->delete("/api/categories/$category->id");

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

}
