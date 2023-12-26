<?php

namespace App\Livewire\App\Pages;

use App\Models\Comment;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Recipe;
use Livewire\Component;

class HomeLivewire extends Component
{
    public function render()
    {
        $recipes = Recipe::take(4)->get();
        $products = Product::take(4)->get();
        $menus = Menu::take(4)->get();
        $comments =Comment::take(3)->get();
        return view('livewire.app.pages.home-livewire',compact('recipes','products','menus','comments'));
    }
}
