<x-app-layout title="Senakicth">
@if(isset($cartCollection))

@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

    <link rel="stylesheet" href="{{ asset ('css/carrito.css') }}"> 
    {{-- <link rel="stylesheet" href="{{ asset ('js/c.css') }}"> --}}
<section >
<h1 class="heading"> Carro de <span>Compras</span> </h1>

    <div class="contain" style="margin-top: 40px">
        @if(session()->has('success_msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success_msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @if(session()->has('alert_msg'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session()->get('alert_msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
     
      
        <div class="comp">
            <div class="comp1">
                @if(\Cart::getTotalQuantity() > 0)
                    <h4>{{ \Cart::getTotalQuantity() }} Producto(s) en el carrito</h4><br>
                @else
                     @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @else
                        @if(session('status'))
                           <div class="alert alert-danger">
                            {{ session('status') }}
                          </div>
                        @endif

                        <h4>No hay productos en su carrito</h4><br>
                        <a href="{{ route('menu') }}" class="btn btn-dark">Continuar en la tienda</a>
                     @endif
                @endif

                

                @foreach($cartCollection as $item)
                    <div class="row">
                        <div class="ros">
                                  {{-- si no tien / usa images si no storage --}}
                                @if (strpos($item->attributes->image , '/') === false)
                                  <img src="/images/{{ $item->attributes->image  }}" alt="">
                              @else
                                  <img src="{{ asset('storage/' . $item->attributes->image ) }}" >
                              @endif
                        {{-- 
                        </div>
                        <div class="des">
                            <p>
                                <b><a href="/shop/{{ $item->attributes->slug }}">{{ $item->name }}</a></b><br>
                                <b>Precio: </b> <span>${{ $item->price }}</span><br>
                                <b>Sub Total: </b> <span>${{ \Cart::get($item->id)->getPriceSum() }}</span><br>
                                {{--                                <b>With Discount: </b>${{ \Cart::get($item->id)->getPriceSumWithConditions() }}--}}
                            </p>
                        </div>
                        <div class="rov">
                            <div class="rovs">
                                <form action="{{ route('cart.update') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="inpu">
                                        <input type="hidden" value="{{ $item->id}}" id="id" name="id">
                                        <input type="number" class="form-control form-control-sm" value="{{ $item->quantity }}"
                                               id="quantity" name="quantity" >
                                        <button class="btn btn-secondary btn-sm" style="margin-right: 25px;"><i class="fa fa-edit"></i></button>
                                    </div>
                                </form>
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $item->id }}" id="id" name="id">
                                    <button class="btn btn-dark btn-sm" style="margin-right: 10px;"><i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
      
        @endif
                @if(count($cartCollection)>0)
                    <form action="{{ route('cart.clear') }}" method="POST">
                        {{ csrf_field() }}
                        <button class="btn btn-secondary btn-md">Borrar Carrito</button> 
                    </form>
                @endif
            </div>
            @if(count($cartCollection)>0)
                <div class="tot">
                    <div class="tots">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>Total: </b>${{ \Cart::getTotal() }} <span class="text-gray-400">cop</span></li>
                        </ul>
                    </div>
                    <div class="">
                        <a href="{{ route('menu') }}" class="btn w-sm">Continue en la tienda</a>
                    </div>
                    <div class="">
                        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="btn w-sm">Proceder al Checkout</button>
                    </div>
                   <div id="wallet_container"></div>
                </div>
            @endif

       
        </div>
        <br><br>
 
        


  
  
          
    
    </div>
</section>



<!-- Asegúrate de tener un elemento con el ID 'miElemento' y un atributo 'data' para tu clave de Mercado Pago -->


<script src="{{ asset('js/pago.js') }}"></script>
</x-app-layout>
