<x-app-layout>
    <div class="cont-perfil bg-white pt-20">
        <div class="container mx-auto ">
            <div class="md:flex no-wrap md:-mx-2 ">
                <div class="w-full md:w-3/12 md:mx-2 ">
                    <div class="bg-white my-4 p-3 border-t-4 border-green-400">
                        <div class="image overflow-hidden">
                            @if(Auth::user()->profile_photo_path ===null)
                                <img src="{{Auth::user()->profile_photo_url}}" alt="."  class="rounded-full h-24 w-24 object-cover mx-auto">
                            @elseif(strpos(Auth::user()->profile_photo_path, 'http') === 0)
                                <img src="{{Auth::user()->profile_photo_path}}" alt="."  class="rounded-full h-24 w-24 object-cover mx-auto">
                            @elseif(file_exists(public_path('storage/' . Auth::user()->profile_photo_path)))
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo_path)}}" alt="" class="rounded-full h-24 w-24 object-cover mx-auto">
                            @endif     
                        </div>
                        <h1 class="text-gray-900 font-bold text-center leading-8 my-1 ">{{Auth::user()->name}}</h1>
                        <h3 class="text-gray-600 font-lg text-center leading-6">Rol: {{Auth::user()->adminlte_desc()}}</h3>
                        <p class=" my-3 text-center text-gray-500 hover:text-gray-600 leading-6">{{Auth::user()->descripcion}}</p>
                        <ul class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                            <li class="flex items-center py-3">
                                <span>Estado</span>
                                <span class="ml-auto"><span class="bg-green-500 py-1 px-2 rounded text-white text-sm">Activo</span></span>
                            </li>
                            <li class="flex items-center py-3">
                                <span>Miembro Desde</span>
                                <span class="ml-auto">{{ $user->created_at->format('M d, Y') }}</span>
                            </li>
                        </ul>
                    </div>

                </div>
                <!-- Datos del Usuario -->
                <div class="w-full md:w-9/12 mx-2 h-64">
                    <div class="my-4 bg-white p-3 shadow-sm rounded-sm">
                        <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                            <span clas="text-green-500">
                                <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </span>
                            <span class="tracking-wide">Acerca De </span>
                          @livewire('app.profile-edit')
                        </div>
                        <div class="text-gray-700">
                            <div class="grid md:grid-cols-2 text-sm">
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Nombre</div>
                                    <div class="px-4 py-2">{{Auth::user()->name}}</div>
                                </div>
                               
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Genero</div>
                                    <div class="px-4 py-2">{{Auth::user()->gender}}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Telefono</div>
                                    <div class="px-4 py-2">+57 {{Auth::user()->telefono}}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Ubicación</div>
                                    <div class="px-4 py-2">{{Auth::user()->ubicacion}}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Email.</div>
                                    <div class="px-4 py-2">
                                        <a class="text-blue-800" href="#">{{Auth::user()->email}}</a>
                                    </div>
                                </div>
                              

                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">facturas </div>
                                    <div class="px-4 py-2"><button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded" data-modal-target="static-modal" data-modal-toggle="static-modal">Ver facturas</button></div>
                                </div>

                                <!-- Main modal -->
                                <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Facturas
                                                </h3>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->

                                            <!-- Suponiendo que tienes acceso al usuario autenticado -->
                                            @foreach(Auth::user()->sales as $sale)
                                                <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                                    <a href="#">
                                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Precio: {{ $sale->price_total }}</h5>
                                                    </a>
                                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Haz clic en "Descargar factura" para ver los detalles de la compra.</p>
                                                    <a href="{{ route('factura', ['id' => $sale->id]) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                        Descargar factura
                                                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            @endforeach

                                            <!-- Modal footer 
                                            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                <button data-modal-hide="static-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                                                <button data-modal-hide="static-modal" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                    <!--Delete Cuenta-->
                    @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                    <x-section-border />

                    <div class="mt-10 sm:mt-0">
                        @livewire('profile.delete-user-form')
                    </div>
                    @endif

                    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                    @livewire('profile.update-profile-information-form')

                    <x-section-border />
                    @endif
                    {{-- @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                    <div class="mt-10 sm:mt-0">
                        @livewire('profile.update-password-form')
                    </div>

                    <x-section-border />
                    @endif --}}

                    {{-- @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                    <div class="mt-10 sm:mt-0">
                        @livewire('profile.two-factor-authentication-form')
                    </div>

                    <x-section-border />
                    @endif --}}

                    {{-- <div class="mt-10 sm:mt-0">
                        @livewire('profile.logout-other-browser-sessions-form')
                    </div> --}}
                </div>
            </div>

        </div>
    </div>    
</x-app-layout>