<?php

namespace App\Livewire\App\Pages;

use App\Models\Product;
use Livewire\Component;

class ProductsLivewire extends Component
{
    protected $listeners = ['render','alert']; 
  
   

    public function render()
    {
        $productos = Product::all();
        return view('livewire.app.pages.products-livewire',compact('productos'));
    }

    public function alert($message){
        $this->dispatch('show-toast', type:"success", message: $message)->self(); 
    }
}
