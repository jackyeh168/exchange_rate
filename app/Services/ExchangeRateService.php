<?php
namespace App\Services;

class ExchangeRateService
{
    public function __construct()
    {
        $this->rate_list = config('exchange_rate.currencies');
    }

    public function convert($from, $to, $price)
    {
        $rate = number_format($this->rate_list[$from][$to], 6);

        return number_format($price, 6) * $rate;
    }
}
