<?php

namespace App\Livewire\App\Pages;

use Livewire\Component;
use Livewire\Attributes\Lazy;
 
#[Lazy]
class NosotrosLivewire extends Component
{
    public function render()
    {
        return view('livewire.app.pages.nosotros-livewire');
    }
}
