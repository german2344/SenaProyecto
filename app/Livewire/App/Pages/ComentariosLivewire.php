<?php

namespace App\Livewire\App\Pages;

use App\Models\Comment;
use Livewire\Component;

class ComentariosLivewire extends Component
{
    protected $listeners = ['render']; 
    public function render()
    {
        $comentarios = Comment::all();
        return view('livewire.app.pages.comentarios-livewire',compact('comentarios'));
    }
}
