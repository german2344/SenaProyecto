<?php

namespace App\Services;

use GuzzleHttp\Client;

class CurrencyService 
{
    protected  $apikey;

    public function __construct($apiKey)
    {
        $this->apikey = $apiKey;
    }

    public function getExchangeRate($fromCurrency, $toCurrency)
    {
        $client = new Client(); 
    
        $response = $client->get("https://open.er-api.com/v6/latest/{$fromCurrency}?apikey={$this->apikey}");
    
        $data = json_decode($response->getBody(), true);
    
        if (isset($data['rates'][$toCurrency])) {
            return $data['rates'][$toCurrency]; 
        }
    
        return null;
    }
}
