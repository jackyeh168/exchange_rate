<?php
namespace App\Services;

use Illuminate\Support\Facades\Config;

class ExchangeRateService
{
    public function __construct()
    {
        $this->rate_list = Config::get('exchange_rate.currencies');
    }

    public function convert($from, $to, $price)
    {
        $rate = number_format($this->rate_list[$from][$to], 6);

        return number_format($price, 6) * $rate;
    }
}
