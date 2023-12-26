<?php

namespace App\Livewire\App\Pages;

use App\Models\Menu;
use Livewire\Component;

class PlatosLivewire extends Component
{
    
    protected $listeners = ['render','alert']; 
    public function render()
    {
        $platos = Menu::all();;
        return view('livewire.app.pages.platos-livewire',compact('platos'));
    }
    public function alert($message){
        $this->dispatch('show-toast', type:"success", message: $message)->self(); 
    }
}
