<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::with('multimedia','comments',)->get();
        return response()->json($menus);
    }

  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Menu::create($request->all());
        return response()->json([
            'respuesta'=> true,
            'mensaje' => 'menu guardado con exito'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        $menu = $menu->with('multimedia','comments')->get();
        return response()->json([
            'respuesta'=> true,
            'product' => $menu,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $menu->update($request->all());
        return response()->json([
             "respuesta" => True,
             "mensaje" => "Producto Actualizado Correctamente"
         ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return response()->json([
            "respuesta" => True,
            "mensaje" => "Prducto Eliminado Exitosamente"
        ],200);
    }
}
