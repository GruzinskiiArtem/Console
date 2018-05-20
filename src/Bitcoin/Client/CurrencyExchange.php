<?php

declare(strict_types=1);

namespace App\Bitcoin\Client;

class CurrencyExchange
{
    private $currency;
    private $value;

    public function __construct($currency, $value)
    {
        $this->currency = $currency;
        $this->value = $value;
    }

    public function getTheApiResponse() : float
    {
        try {
            $params = array('currency' => $this->currency, 'value' => $this->value);
            $url = 'https://blockchain.info/tobtc?' . http_build_query($params);
            $inquiry = curl_init($url);
            curl_setopt($inquiry, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($inquiry, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($inquiry, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($inquiry);
            $info = curl_getinfo($inquiry);
            if ($result === false) {
                throw new \Exception('Url not found.');
            } elseif ($info['http_code'] >= 400) {
                throw new \Exception("An error has occurred. Error code {$info['http_code']}");
            } else {
                return json_decode($result, true);
            }
        }
        catch(\Exception $error) {
            echo $error->getMessage();
            exit();
        }
    }
}