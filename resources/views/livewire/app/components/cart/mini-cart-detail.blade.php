<div>
    <x-dropdown width="auto" >
        <x-slot name="trigger">
            <button class="mx-6" href="#">
                <i class="fas fa-shopping-cart"></i>
                @if(\Cart::getTotalQuantity() != 0)
                    {{ \Cart::getTotalQuantity() }}
                @endif 
            </button>
        </x-slot>
        <x-slot name="content">
            <div class="block   px-4 py-2 text-sm text-gray-400">
                        {{ __('Carrito de compras') }}
            </div>
            @if (\Cart::getTotalQuantity() != 0)
                <div class="w-full max-w-md max-h-96 overflow-y-auto p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <div class="flow-root"> 
                        
                        @foreach($cartCollection as $item)
                            <div class="py-2">
                                <div class="flex justify-center items-center border-b-2 border-gray-500">
                                    <div class="flex-shrink-0">
                                        @if (strpos($item->attributes->image , '/') === false)
                                        <img class="w-12 h-12 rounded-full" src="/images/{{ $item->attributes->image  }}" alt="">
                                        @else
                                            <img class="w-12 h-12 rounded-full" src="{{ asset('storage/' . $item->attributes->image ) }}" >
                                        @endif
                                    
                                    </div>
                                    <div class="flex-shrink-0 min-w-0 ms-4 mx-2">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            {{$item->name}}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            cantidad: {{$item->quantity}}
                                        </p>
                                    </div>
                                    <div class="mx-2 px-4 flex-shrink-0 items-center text-base font-semibold text-gray-900 dark:text-white">
                                        ${{$item->price}}
                                    </div>
                                </div>
                            </div>
                        @endforeach  
                
                    
                    </div>
                </div>
                
                <div class="flex justify-center items-center m-3" >
                <p class="text-base px-3 text-gray-500"><b>Total:</b> ${{ \Cart::getTotal() }} COP</p> 
                <a href="{{ route ('cart.index') }}" class="text-green-500" >
                        <button type="button" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-1.5 text-center me-2 mb-2">Ver Carrito</button>
                    </a>
                </div>
            @else
                <div class="min-w-max p-2">
                    <p class=" w text-sm font-medium text-gray-900  dark:text-white">¡ El carrito se encuentra vacio !</p>
                </div>
            @endif
        </x-slot>
    </x-dropdown>

</div>
