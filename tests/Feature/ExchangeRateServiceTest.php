<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExchangeRateServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_exchange_rate_happy_path()
    {
        $response = $this->get('/api/exchange_rate?from=USD&to=TWD&price=100');

        $response->assertStatus(200);
        $response->assertJson([
            "price" => 3044.4
        ]);
    }

    public function test_exchange_rate_without_from()
    {
        $response = $this->get('/api/exchange_rate?to=TWD&price=100');

        $response->assertStatus(400);
    }

    public function test_exchange_rate_without_to()
    {
        $response = $this->get('/api/exchange_rate?from=USD&price=100');

        $response->assertStatus(400);
    }

    public function test_exchange_rate_without_price()
    {
        $response = $this->get('/api/exchange_rate?from=USD&to=TWD');

        $response->assertStatus(400);
    }

    public function test_exchange_rate_with_wrong_from()
    {
        $response = $this->get('/api/exchange_rate?from=TEST&to=TWD&price=100');

        $response->assertStatus(400);
    }

    public function test_exchange_rate_with_wrong_to()
    {
        $response = $this->get('/api/exchange_rate?from=USD&to=TEST&price=100');

        $response->assertStatus(400);
    }

    public function test_exchange_rate_with_wrong_price()
    {
        $response = $this->get('/api/exchange_rate?from=USD&to=TWD&price=TEST');

        $response->assertStatus(400);
    }
}
