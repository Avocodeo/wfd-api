<?php

namespace Tests\Feature;

use App\Inventory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InventoriesTest extends TestCase
{
    // Fake data, and dump / migrate databases each time
    use WithFaker, RefreshDatabase;

    public function testCanCreateInventory()
    {
        $this->withoutExceptionHandling(); // when exceptions are thrown laravel catches them but we want the exception

        $attributes = [
            'quantity' => $this->faker->numberBetween(1, 30),
            'low' => $this->faker->boolean(),
            'high' => $this->faker->boolean(),
        ];

        $this->get('/inventories/create')->assertStatus(200); // they can access a create page
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

        $this->get("/api/inventories/$inventory->item_id")
            ->assertStatus(200);
    }


    public function testCanUpdateInventory()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'quantity' => 300,
            'low' => $this->faker->boolean(),
            'high' => $this->faker->boolean(),
        ];

        $inventory = factory(Inventory::class)->create();

        $this->patch("/api/inventories/$inventory->quantity", $attributes);

        $this->assertDatabaseHas('inventories', ['quantity' => 300]);
    }

    public function testCanDeleteInventory()
    {
        $inventory = factory(Inventory::class)->create();

        $this->delete("/api/inventories/$inventory->id");

        $this->assertDatabaseMissing('inventories', ['id' => $inventory->id]);
    }
}
