<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('multimedia','comments',)->get();
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
     {
         $request->validate([
             'name' => 'required|string',
             'price' => 'required|numeric',
             'description' => 'required|string',
             'quantity' => 'required|numeric',
             'category_id' => 'required|exists:categories,id',
             'user_id' => 'required|exists:users,id',
            //  'multimedia' => 'required|array',
            //  // 'multimedia.*.type' => 'required|string|in:imagen',
            //  'multimedia.*.ruta' => 'required|string',
         ]);
    
         // Crea un nuevo producto
         $product = Product::create([
             'name' => $request->input('name'),
             'price' => $request->input('price'),
             'description' => $request->input('description'),
             'quantity' =>$request->input('quantity'),
             'user_id' => $request->input('user_id'),  // O cualquier lógica que uses para obtener el ID del usuario actual
             'category_id' => $request->input('category_id'),
         ]);
    
         // Agrega multimedia al producto
        //  foreach ($request->input('multimedia') as $media) {
        //      $product->multimedia()->create($media);
        //  }
         // Retorna una respuesta de éxito o el objeto creado, según tus necesidades
         return response()->json(['respuesta'=>true, 'message' => 'Producto creado exitosamente', 'data' => $product], 201);
     }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product = $product->with('multimedia','comments')->get();
        return response()->json([
            'respuesta'=> true,
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'string',
            'price' => 'numeric',
            'description' => 'string',
            'quantity' => 'numeric',
            'category_id' => 'exists:categories,id',
            'user_id' => 'exists:users,id',
        ]);

        // Actualiza los campos del producto según los datos proporcionados en la solicitud
        $product->update([
            'name' => $request->input('name', $product->name),
            'price' => $request->input('price', $product->price),
            'description' => $request->input('description', $product->description),
            'quantity' => $request->input('quantity', $product->quantity),
            'user_id' => $request->input('user_id', $product->user_id),
            'category_id' => $request->input('category_id', $product->category_id),
        ]);
        // Retorna una respuesta de éxito o el objeto actualizado, según tus necesidades
        return response()->json(['respuesta' => true, 'message' => 'Producto actualizado exitosamente', 'data' => $product], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            "respuesta" => True,
            "mensaje" => "Prducto Eliminado Exitosamente"
        ],200);
    }
}
