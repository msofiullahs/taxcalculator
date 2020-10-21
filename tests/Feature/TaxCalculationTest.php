<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaxCalculationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->postJson('/', ['salary' => 25000000, 'status' => 'TK0']);

        $response
            ->assertStatus(200)
            ->assertJson([
                'tax' => 31900000,
            ]);
    }
}
