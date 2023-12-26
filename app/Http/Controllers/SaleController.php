<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class SaleController extends Controller
{
    public function factura($id){
        
        $venta = Sale::with('carts','user', 'delivery')->find($id);
        $pdf = Pdf::loadView('home.factura', compact('venta'));
        return $pdf->stream();
    }

    public function index()
    {
        $sales = Sale::all();
        return View::make('profile.show', ['sales' => $sales]);
        
    }
}
