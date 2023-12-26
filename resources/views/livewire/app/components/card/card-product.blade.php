<div >
    <link rel="stylesheet" href="{{ asset('css/app/livewire/detalleProduct.css')}}">
    <!-- Card product-->
    <div class="box">
            <div class="card-footer">
                <div class="row">
                    <div class="icons">
                        <a href="#"  wire:click.prevent="addItem(1,{{$product}})" class="fas fa-shopping-cart"></a>
                        <a href="#" class="fas fa-heart"></a>
                        <!--evita el comportamiento predeterminado del clic en este caso en un link-->
                        <a  wire:click.prevent="openModalDetalle()" href="#" class="fas fa-eye" id="loca"></a>
                    </div>
                </div>
            </div>
        <div class="image">
            <img src="{{$ImgCard}}" alt="..." class=""> 
        </div>
        <div class="content">
            <h3>{{substr($product->name, 0, 20)}}</h3>
            <p>{{substr($product->description, 0, 100)}}...</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <div class="price">$ {{ $product->price }} <span>cop</span></div>
        </div>
    </div> 



    <!--detalles de producto-->
    <x-modificados-jet.modal wire:model="openModalDetailProduct" maxWidth="full" >
            <div class="contDetalle">
                    <!--imagenes del producto-->
                    <div class="imgs">
                        <div class="imgMain">
                            <img src="{{ $mainImage }}" alt="" class="object-cover">
                        </div>
                        <div class="imgsPrevs">
                            <div class="sticky top-0 z-50 overflow-hidden">
                                <div class="flex-wrap hidden md:flex">
           
                                    @foreach ($previewImages as $image)
                                        <div class="w-1/2 p-2 sm:w-1/4">
                                            <a href="#" wire:click="changeMainImage('{{ $image }}')"
                                                class="block border border-blue-300 dark:border-transparent dark:hover:border-blue-300 hover:border-blue-300">
                                                <img src="{{asset('storage/' . $image) }}" alt="" class="object-cover w-full lg:h-20">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--seccion de detalle texto-->
                    <div class="descriptionProduct">
                        <div class="flex">
                            <x-danger-button class="flex ml-auto"  wire:click="$set('openModalDetailProduct', false)">X</x-danger-button>
                        </div>
                        <div class="lg:pl-20">
                            <div class="mb-8 ">
                                <h2 class="max-w-xl mt-2 mb-6 text-2xl font-bold dark:text-gray-400 md:text-4xl">
                                {{$product->name}}
                                </h2>
                               
                                <p class="max-w-md mb-8 text-gray-700 dark:text-gray-400">
                                   {{$product->desription}}
                                </p>
                                <p class="inline-block mb-8 text-4xl font-bold text-gray-700 dark:text-gray-400 ">
                                    <span>${{$product->price}}</span>
                                    <span
                                        class="text-base font-normal text-gray-500 line-through dark:text-gray-400">$1500.99</span>
                                </p>
                                <p class="text-green-600 dark:text-green-300 ">{{$product->quantity}} en existencia</p>
                            </div>

                            <div class="mb-4">
                                <label for=""
                                class="w-full text-xl font-sm mb-2 text-gray-700 dark:text-gray-400">Descripción</label>
                                <p>{{$product->description}}</p>
                            </div>

                            {{-- <div class="w-32 mb-8 ">
                                <label for=""
                                    class="w-full text-xl font-semibold text-gray-700 dark:text-gray-400">Quantity</label>
                                <div class="relative flex flex-row w-full h-10 mt-4 bg-transparent rounded-lg">
                                    <button
                                        class="w-20 h-full text-gray-600 bg-gray-300 rounded-l outline-none cursor-pointer dark:hover:bg-gray-700 dark:text-gray-400 hover:text-gray-700 dark:bg-gray-900 hover:bg-gray-400">
                                        <span class="m-auto text-2xl font-thin">-</span>
                                    </button>
                                    <input type="number"
                                        class="flex items-center w-full font-semibold text-center text-gray-700 placeholder-gray-700 bg-gray-300 outline-none dark:text-gray-400 dark:placeholder-gray-400 dark:bg-gray-900 focus:outline-none text-md hover:text-black"
                                        placeholder="1">
                                    <button
                                        class="w-20 h-full text-gray-600 bg-gray-300 rounded-r outline-none cursor-pointer dark:hover:bg-gray-700 dark:text-gray-400 dark:bg-gray-900 hover:text-gray-700 hover:bg-gray-400">
                                        <span class="m-auto text-2xl font-thin">+</span>
                                    </button>
                                </div>
                            </div> --}}

                            <div class="flex flex-wrap items-center -mx-4 ">
                                <div class="w-full px-4 mb-4 lg:w-1/2 lg:mb-0">
                                    <button
                                    wire:click="addItem(1,{{$product}})"
                                        class="flex items-center justify-center w-full p-4  rounded-md dark:text-gray-200  bg-green-600 border-blue-600 text-gray-100 ">
                                        Agregar al Carrito
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
    </x-modificados-jet.modal>
</div>
