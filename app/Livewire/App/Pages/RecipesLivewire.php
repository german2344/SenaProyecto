<?php

namespace App\Livewire\App\Pages;

use App\Models\Recipe;
use Livewire\Component;

class RecipesLivewire extends Component
{
    protected $listeners = ['render']; 
    public function render()
    {
        $recetas = Recipe::with('multimedia','ingredients','preparationSteps','comments')->get();
        return view('livewire.app.pages.recipes-livewire',compact('recetas'));
    }
}
