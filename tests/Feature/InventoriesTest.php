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
            'item_id' => $this->faker->numberBetween(1, 20),
            'item_quantity' => $this->faker->numberBetween(1, 30),
            'item_low' => $this->faker->boolean(),
            'item_high' => $this->faker->boolean(),
            'item_close_to_expiry' => $this->faker->boolean(),
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
            'item_id' => 200,
            'item_quantity' => 300,
            'item_low' => $this->faker->boolean(),
            'item_high' => $this->faker->boolean(),
            'item_close_to_expiry' => $this->faker->boolean(),
        ];

        $inventory = factory(Inventory::class)->create();

        $this->patch("/api/inventories/$inventory->item_id", $attributes);

        $this->assertDatabaseHas('inventories', ['item_id' => '200']);
    }

    public function testCanDeleteInventory()
    {
        $inventory = factory(Inventory::class)->create();

        $this->delete("/api/inventories/$inventory->id");

        $this->assertDatabaseMissing('inventories', ['item_id' => $inventory->item_id]);
    }
}
