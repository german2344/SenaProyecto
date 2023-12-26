<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
class RecipeController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.recipes.index')->only('index');
        $this->middleware('can:admin.recipes.store')->only('store');
        $this->middleware('can:admin.recipes.update')->only('update');
        $this->middleware('can:admin.recipes.destroy')->only('destroy');
    }
    public function index()
    {
        return view('admin.cruds.recipes');
    }
}
