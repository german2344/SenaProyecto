<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class FormAuth extends Component
{
    public $openModalAuth = true;
    public function render()
    {
        return view('livewire.auth.form-auth');
    }
}
