<?php

namespace App\Livewire\App\Components\Card;

use App\Livewire\App\Components\Cart\MiniCartDetail;
use App\Livewire\App\Pages\PlatosLivewire;
use App\Models\Menu;
use Livewire\Component;
class CardPlato extends Component
{
    public $plato,$openModalDetailPlato=false;
    public $images=[];
    public $currentSlide = 0;
    public $imgPlatoCard;
    public function mount(Menu $plato)
    {
        $this->plato = $plato;
        if($plato->multimedia){
            foreach($plato->multimedia as $index => $imagenes){
                if($index ===0){
                    $this->imgPlatoCard = asset('storage/' . $imagenes->ruta);
                }
            }
        }
    }
    public function render()
    {
        return view('livewire.app.components.card.card-plato');
    }
    public function addItem($quantity, Menu $plato){
        \Cart::add(array(
            'id' => $plato->id,
            'name' => $plato->name,
            'price' => $plato->price,
            'quantity' => $quantity,
            'attributes' => array(
                'image' =>  $plato->multimedia->first()->ruta, // Obtener la imagen del modelo
            )
        ));
        $this->dispatch('alert','item agregado al carrito')->to(PlatosLivewire::class);
        $this->dispatch('render')->to(MiniCartDetail::class);
    }
   
}
