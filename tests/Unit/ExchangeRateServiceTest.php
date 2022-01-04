<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Config;

class ExchangeRateServiceTest extends TestCase
{
    public function test_convert_exchange_rate_happy_path()
    {
        Config::shouldReceive('get')
        ->once()
        ->with("exchange_rate.currencies")
        ->andReturn([
            "JPD" =>
            [
                "TWD" => 1.111,
            ]
        ]);

        $service = new \App\Services\ExchangeRateService();
        $result = $service->convert(
            'JPD',  // from
            'TWD',  // to
            200     // price
        );

        $this->assertSame(222.2, $result);
    }
}
