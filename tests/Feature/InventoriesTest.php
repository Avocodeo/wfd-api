<?php

namespace Tests\Feature;

use App\Inventory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Ingredient;

class InventoriesTest extends TestCase
{
    // Fake data, and dump / migrate databases each time
    use WithFaker, RefreshDatabase;

    public function testCanCreateInventory()
    {
        $this->withoutExceptionHandling(); // when exceptions are thrown laravel catches them but we want the exception

        $attributes = [
            'ingredient_id' => factory(Ingredient::class)->create()->id,
            'quantity' => $this->faker->randomFloat(),
            'low' => $this->faker->randomFloat(),
            'high' => $this->faker->randomFloat(),
        ];

        $this->post('api/inventories', $attributes);
        $this->assertDatabaseHas('inventories', $attributes);
    }

    public function testCanViewInventory()
    {
        $this->withoutExceptionHandling();
        factory(Inventory::class)->create();

        $this->get("/api/inventories")
            ->assertStatus(200);
    }

    public function testCanViewInventoryItem()
    {
        $this->withoutExceptionHandling();

        $inventory = factory(Inventory::class)->create();

        $this->get("/api/inventories/$inventory->id")
            ->assertStatus(200);
    }


    public function testCanUpdateInventory()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'ingredient_id' => factory(Ingredient::class)->create()->id,
            'quantity' => 300,
            'low' => $this->faker->numberBetween(0, 10),
            'high' => $this->faker->numberBetween(0, 100),
        ];

        $inventory = factory(Inventory::class)->create();

        $this->patch("/api/inventories/$inventory->id", $attributes);

        $this->assertDatabaseHas('inventories', ['quantity' => 300]);
    }

    public function testCanDeleteInventory()
    {
        $inventory = factory(Inventory::class)->create();

        $this->delete("/api/inventories/$inventory->id");

        $this->assertDatabaseMissing('inventories', ['id' => $inventory->id]);
    }
}
