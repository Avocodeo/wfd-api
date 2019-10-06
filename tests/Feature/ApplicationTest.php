<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApplicationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testApplicationRunning()
    {
        $response = $this->get('/api/status');

        $response->assertStatus(200);
    }
}
