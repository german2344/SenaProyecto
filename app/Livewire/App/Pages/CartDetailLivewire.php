<?php

namespace App\Livewire\App\Pages;

use App\Livewire\App\Components\Cart\MiniCartDetail;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\MercadoPagoService;
use App\Models\Menu;
use Livewire\Component;

class CartDetailLivewire extends Component
{
    // public function __construct(

    //     private MercadoPagoService $mercadoPagoService,
       
    // ){}

    public function render()
    {
        $products = Menu::all();
        $cartCollection = \Cart::getContent();
        //dd($products);
        return view('livewire.app.pages.cart-detail-livewire',compact('products','cartCollection'));
    }
    
        public function shop()
        {
            $products = Menu::all();
            return view('home.menu', compact('products'));
        }
    
        public function cart()  {
        
           $client = $this->mercadoPagoService->crearPreferece();
          
           
            $cartCollection = \Cart::getContent();
    
            return view('cart',compact('cartCollection', 'client'));
        }
        
        public function removeItem($id){
            \Cart::remove($id);
            $this->dispatch('render')->to(MiniCartDetail::class);
            $this->dispatch('show-toast', type:"info", message:"item removido con exito")->self(); 
        }
        public function add(Request $request){
       
            \Cart::add(array(
                'id' => $request->id,
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'attributes' => array(
                    'image' =>  $item->multimedia->first()->ruta, // Obtener la imagen del modelo
                    'slug' => $request->slug
                )
            ));
        }
    
        public function update(Request $request){
            \Cart::update($request->id,
                array(
                    'quantity' => array(
                        'relative' => false,
                        'value' => $request->quantity
                    ),
            ));
            return redirect()->route('cart.index')->with('success_msg', 'Cart is Updated!');
        }
    
        public function clearCart(){
            \Cart::clear();
            $this->dispatch('render')->to(MiniCartDetail::class);
            $this->dispatch('show-toast', type:"success", message:"el carrito se vació con exito")->self(); 
        }
    
}
