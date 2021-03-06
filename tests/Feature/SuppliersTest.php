<?php

namespace Tests\Feature;

use App\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SuppliersTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function testCanCreateSupplier()
    {
        // $this->withoutExceptionHandling();

        $attributes = [
            'name' => $this->faker->name,
            'type' => 'food',
        ];


        $this->post('api/suppliers', $attributes);
        $this->assertDatabaseHas('suppliers', $attributes);
    }

    public function testCanViewSuppliers()
    {
        $this->withoutExceptionHandling();
        factory(Supplier::class)->create();

        $this->get("/api/suppliers")
            ->assertStatus(200);
    }

    public function testCanViewSupplier()
    {
        $this->withoutExceptionHandling();

        $supplier = factory(Supplier::class)->create();

        $this->get("/api/suppliers/$supplier->id")
            ->assertStatus(200);
    }


    public function testCanUpdateSupplier()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'name' => 'Pearl',
            'type' => 'chicken',
        ];

        $supplier = factory(Supplier::class)->create(['name' => 'Pearl', 'type' => 'chicken']);

        $this->patch("/api/suppliers/$supplier->id", $attributes);

        $this->assertDatabaseHas('suppliers', ['name' => 'Pearl']);
    }

    public function testCanDeleteSupplier()
    {
        $supplier = factory(Supplier::class)->create();

        $this->delete("/api/suppliers/$supplier->id");

        $this->assertDatabaseMissing('suppliers', ['id' => $supplier->id]);
    }
}
