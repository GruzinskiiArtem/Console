<?php

declare(strict_types=1);

namespace App\Bitcoin\Client;

class BitcoinCurrencies extends BlockChain
{
    public function getCurrencies($option) : array
    {
        $cyrrencies = array();
        $exchangeRates = parent::getExchangeRates();
        if ($option == 'asc') {
            asort($exchangeRates);
        } elseif ($option == 'desc') {
            arsort($exchangeRates);
        }
        foreach ($exchangeRates as $currencyName=>$course) {
            $cyrrencies[] = $currencyName;
        }
        return $cyrrencies;
    }
}