<?php

namespace App\Livewire\Admin;

use App\Models\Sale;
use Livewire\Component;

class ShowSales extends Component
{
    public $detalleVenta;
    public $search,$openModalDetailSale = false;
    protected $listeners = ['render'];
    public function render()
    {
        $sales = Sale::where('order_number', 'LIKE', '%' . $this->search . '%')->paginate(5);
        return view('livewire.admin.show-sales',compact('sales'));
    }
    public function openModalDetalle(Sale $sale){
       $this->detalleVenta = $sale->detailSales;
       $this->openModalDetailSale = true;
    }

}
