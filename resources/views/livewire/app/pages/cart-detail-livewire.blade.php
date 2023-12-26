<div>
    <link rel="stylesheet" href="{{ asset ('css/carrito.css') }}"> 
    @if(isset($cartCollection))
      

    <section >
        <h1 class="heading"> Carro de <span>Compras</span> </h1>
        <div class="contain" style="margin-top: 40px">       
            <div class="comp">
                <div class="comp1">
                    @if(\Cart::getTotalQuantity() > 0)
                        <h4>{{ \Cart::getTotalQuantity() }} Producto(s) en el carrito</h4><br>
                    @else
                        @if(session('status'))
                            <h4>{{ session('status') }}</h4><br>
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
                                   
                                    <button wire:click="removeItem({{$item->id}})" class="btn btn-dark btn-sm" style="margin-right: 10px;"><i class="fa fa-trash"></i></button>
                                   
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
        
            @endif
                    @if(count($cartCollection)>0)
                            <button wire:click="clearCart()" class="btn btn-secondary btn-md">Borrar Carrito</button> 
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
    
            


    
            {{-- <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                datos de envio 
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form class="p-4 md:p-5">
                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <div class="col-span-2">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                                </div>
                                <div class="col-span-2">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telefono</label>
                                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                                </div>
                                <div class="col-span-2">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Barrio</label>
                                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Direccion</label>
                                    <input type="name" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Cra 22" required="">
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">codigo postal</label>
                                    <input type="name" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="19007" required="">
                                </div>                                
                                <div class="col-span-2">
                                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Description</label>
                                    <textarea id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write product description here"></textarea>                    
                                </div>

                            </div>
                            <a href="{{ route('paypal') }}" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Proceder con el pago 
                            </a>
                        </form>
                    </div>
                </div>
            </div>  --}}

              <!-- Main modal -->
            <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                datos de envio 
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form action="{{route('envio.store')}}" class="p-4 md:p-5" method="POST">
                        @csrf
                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <div class="col-span-2">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="su nombre completo" required="">
                                </div>
                                <div class="col-span-2">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telefono</label>
                                <input type="text" name="number" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Telefono de contacto" required="">
                            </div>
                            <div class="col-span-2">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Barrio</label>
                                <input type="text" name="district" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="barrio donde vive" required="">
                            </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Direccion</label>
                                    <input type="name" name="address" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ej: Cra 22" required="">
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">codigo postal</label>
                                <input type="name" name="postal_code" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="19007" required="">
                            </div>
                            </div>
                            <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Proceder con el pago 
                            </button>
                        </form>
                    </div>
                </div>
            </div> 

        
        </div>
    </section>
<!-- Asegúrate de tener un elemento con el ID 'miElemento' y un atributo 'data' para tu clave de Mercado Pago -->
{{-- <div id="miElemento" data-mercado-pago-key="{{ config('services.mercadopago.key') }}" data-mi-variable="{{ $client->id }}"></div> --}}
    <script src="{{ asset('js/pago.js') }}"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
           @this.on('show-toast', (event) => {
               toastr[event.type](event.message);
           });
       });
   </script>
</div>
