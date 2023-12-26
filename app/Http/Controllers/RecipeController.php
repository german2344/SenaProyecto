<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    public function pdf($id){
        
        $receta = Recipe::find($id);
        $recipe = $receta->with('multimedia','ingredients','preparationSteps','comments')->find($receta->id);
        $pdf = Pdf::loadView('home.pdf', compact('recipe'));
        return $pdf->stream();
    }
}
