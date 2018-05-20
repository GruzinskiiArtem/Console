<?php

declare(strict_types=1);

namespace App\Bitcoin\Client;

class BitcoinConvert extends CurrencyExchange
{
    public function __construct($currency, $value)
    {
        parent::__construct($currency, $value);
    }

    public function getConversion() : float {
        $amount = parent::getTheApiResponse();
        return round($amount, 2);
    }
}