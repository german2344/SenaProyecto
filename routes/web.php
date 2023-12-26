<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactanosController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\SaleController;
use App\Livewire\App\Pages\CartDetailLivewire;
use App\Livewire\App\Pages\ComentariosLivewire;
use App\Livewire\App\Pages\ContactLivewire;
use App\Livewire\App\Pages\HomeLivewire;
use App\Livewire\App\Pages\NosotrosLivewire;
use App\Livewire\App\Pages\PlatosLivewire;
use App\Livewire\App\Pages\ProductsLivewire;
use App\Livewire\App\Pages\RecipesLivewire;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;


//Login Con Facebook
Route::get('authfacebook/redirect',[AuthController::class,'redirectFacebook'])->name('authfacebook.redirect');
Route::get('authfacebook/callback',[AuthController::class,'callbackFacebook'])->name('authfacebook.callback');
//Login Con Google
Route::get('authgoogle/redirect',[AuthController::class,'redirectGoogle'])->name('authgoogle.redirect');
Route::get('/google-callback',[AuthController::class,'callbackGoogle']);

Route::get('',HomeLivewire::class)->name('home');    
//Recetas
Route::get('recetas',RecipesLivewire::class)->name('recetas');
Route::get('/recetas/{recetas}/recetas',[HomeController::class,'ver'])->name('verRecetas');
//Productos
Route::get('productos',ProductsLivewire::class)->name('productos');
//Nostros
Route::get('nosotros',NosotrosLivewire::class)->name('nosotros');
//Contactanos
Route::get('contactanos',ContactLivewire::class)->name('contactos');
//Menu
Route::get('menu',PlatosLivewire::class)->name('menu');
//Opiniones
Route::get('comentarios',ComentariosLivewire::class)->name('comentarios.index');



Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/descarga_pdf/{id}',[RecipeController::class,'pdf'])->name('recetas.pdf');
    Route::get('/cart',CartDetailLivewire::class)->name('cart.index');
    Route::get('venta/{id}',[SaleController::class,'factura'])->name('factura');
    Route::post('envio',[DeliveryController::class,'store'])->name('envio.store');
    Route::post('comentarios',[CommentController::class,'store'])->name('comentarios.store');
    Route::post('contactanos',[ContactanosController::class,'store'])->name('contactanos.store');
    Route::post('/add', [CartController::class, 'add'])->name('cart.store');
    Route::post('/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');
    //menu
    Route::resource('/menus',MenuController::class)->names('menus');
    //Payment
    Route::get('/paypal/pay',[PaymentController::class, 'paypalPayment'])->name('paypal');
    Route::get('/paypal/status',[PaymentController::class, 'paypalStatus']);
});


