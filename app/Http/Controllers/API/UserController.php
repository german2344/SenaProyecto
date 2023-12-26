<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::create($request->all());
        return response()->json([
            'respuesta'=> true,
            'mensaje' => 'usuario guardado con exito'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return response()->json($user);
        // return response()->json([
        //     "respuesta" => True,
        //     "mensaje" => "Usuario Actualizado Correctamente"
        // ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    
     public function destroy(User $user)
     {
         $user->delete();
         return response()->json([
             "respuesta" => True,
             "mensaje" => "Usuario Eliminado Exitosamente"
         ],200);
     }



      
      public function login(Request $request)
      {
          if (!Auth::attempt($request->only('email', 'password'))) {
              return response()
              ->json(['message' => 'Unauthorized'], 401);
          }
 
          $user = User::where('email', $request['email'])->firstOrFail();
 
          $token = $user->createToken('auth_token')->plainTextToken;
 
          return response()
          ->json([
              'message'      => 'Hola! ' . $user->name,
              'access_token' => $token,
              'token_type'   => 'Portadora',
              'user'         => $user,
          ]);
      }

       //  creado por german 2023

       public function register(Request $request)
       {
           $validator = Validator::make($request->all(),[
               'name'            => 'required|string|max:255',
               'email'           => 'required|string|email|unique:users',
               'password'        => 'required|string|min:8',
               'passwordconfirm' => 'required|min:8|same:password'
           ]);
  
  
           if($validator->fails())
           {
               return response()->json($validator->errors());
           }
  
           $user =  User::create([
               'name'            => $request -> name,
               'email'           => $request -> email,
               'password'        => Hash::make($request->password),
               ]);
  
           $token = $user->createToken('auth_token')->plainTextToken;
  
  
           return response()->
           json(['data' => $user, 'access_token' => $token, 'token_type' => 'Bearer', ]);
  
       }

      


}
