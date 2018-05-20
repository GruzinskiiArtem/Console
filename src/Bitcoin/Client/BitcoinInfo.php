<?php

declare(strict_types=1);

namespace App\Bitcoin\Client;

class BitcoinInfo extends BlockChain
{
    public function getBitcoinInfo() : array
    {
        $rows = array();
        $exchangeRates = parent::getExchangeRates();

        foreach ($exchangeRates as $currencyName=>$course)
        {
            $rows[] = array($currencyName, $course['15m'], $course['last'], $course['buy'], $course['sell']);
        }

        return $rows;
    }
}