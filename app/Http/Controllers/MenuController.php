<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

class MenuController extends Controller
{
    public function mercadoPago(){
        MercadoPagoConfig::setAccessToken(config('services.mercadopago.token'));

        $client = new PreferenceClient();
        $preference = $client->create([
            "items" => array(
                array(
                    "title" => "Meu produto",
                    "quantity" => 1,
                    "currency_id" => "BRL",
                    "unit_price" => 100
                )
            )
        ]);
    }

}
