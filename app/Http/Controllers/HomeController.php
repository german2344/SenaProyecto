<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Recipe;

class HomeController extends Controller
{

    public function index(){
        $recipes = Recipe::take(4)->get();
        $products = Product::take(4)->get();
        $menus = Menu::take(4)->get();
        $comments =Comment::take(3)->get();
        return view('home.index',compact('recipes','products','menus','comments'));
    }

    public function menu(){
        return view('home.menu');
    }

    public function opiniones(){
        return view('home.opiniones');
    }

    public function productos(){

     $productos =Product::all();
     return view('home.product',compact('productos'));

    }

   //Recestas
     public function recetas(){
        
         $recetas = Recipe::with('multimedia','ingredients','preparationSteps','comments')->get();
         return view('home.recetas',compact('recetas'));
     }
     public function ver(Recipe $recetas)
     {
         // $recetas = Recetas::findOrfail($id);
         $recetas = $recetas->with('multimedia','ingredients','preparationSteps','comments')->find($recetas->id);
        
        return view('home.verRecetas',compact('recetas'));
     }


    // Nosotros
    public function nosotros(){
        return view('home.nosotros');
    }
    
    //Formulario para susbir recetas
    public function formulario()
    {
        return view('home.subirRecetas');
    }

    //Perfil de usuario
    public function prueba(){
        return view('home.prueba');
    }

    public function init(){
        return view('auth.login');
    }

   public function verr(){
    return view('home.ver');
   }
}






