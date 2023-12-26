<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;
use Symfony\Component\Mailer\DelayedEnvelope;

class DeliveryController extends Controller
{
    public function store(Request $request,Delivery $delivery)
    {
        Delivery::create($request->all());
        
        return to_route('paypal');
    }

    public function factura()
    {
        
    } 
}
  

