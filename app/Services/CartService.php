<?php

namespace App\Services;

use App\Models\Cart;

class CartService{
       
 


    public function DatosCart()
    {
        // Obtén todos los elementos del carrito
        $cartItems = \Cart::getContent();

        return $cartItems;
    }

 
    public function ClearCart()
    {
        \Cart::clear();
    }
  


    public function PreciCart(){
        

     
    $apiKey = '424766632d6f447ea1ef3e4379a3cf1a'; 
    $exchange = new CurrencyService($apiKey);
    $tasaCOPaUSD = $exchange->getExchangeRate('USD', 'COP'); 

    $totalEnPesos = \Cart::getTotal();

    $totalEnDolares = $totalEnPesos / $tasaCOPaUSD;

    return $totalEnDolares;
    }

   
}
