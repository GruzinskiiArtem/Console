<?php

declare(strict_types=1);

namespace App\Bitcoin\Client;

class BlockChain
{
    private $url = 'https://blockchain.info/ru/ticker';
    public function getExchangeRates() : array {
        try {
            $inquiry = curl_init($this->url);
            curl_setopt($inquiry, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($inquiry, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($inquiry, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($inquiry);
            $info = curl_getinfo($inquiry);
            if ($result === false)
            {
                throw new \Exception('Url not found.');
            } elseif ($info['http_code'] >= 400){
                throw new \Exception("An error has occurred. Error code {$info['http_code']}");
            } else {
                return json_decode($result, true);
            }
        }
        catch (\Exception $error) {
            echo $error->getMessage();
            exit();
        }

    }
}