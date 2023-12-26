<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $title ?? 'pdf' }}</title>
        <link rel="icon" href="{{ asset('favicons/LogoSenakicht.ico') }}">
        <!-- Fonts -->
          @vite(['resources/css/app.css', 'resources/js/app.js'])
      
        @livewireStyles 
    </head>
    <body >
        <div id="app">
            <main >
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 text-center">
                        <tr class="cursor-pointer  text-left text-xs font-medium text-gray-500 uppercase">
                            <th scope="col" class="px-6 py-3">Nombre</th>
                            <th scope="col" class="px-6 py-3">Imagen</th>
                            <th scope="col" class="px-6 py-3">Cantidad</th>
                            <th scope="col" class="px-6 py-3">Descripción</th>
                            <th scope="col" class="px-6 py-3">Precio</th>

                        </tr>
                        
                    </thead>
                    <tbody >
                        @foreach ($platos as $menu)
                            <tr >
                                <td class="px-6 py-6">{{$menu->name}}</td>
                                <td class="px-6 py-6" >
                                    @foreach($menu->multimedia as $index => $imagen)
                                    @if($index === 0)
                                        <img src="{{ asset('storage/' . $imagen->ruta) }}"  width="100px" alt="...">
                                    @endif
                                @endforeach

                                </td>
                                <td class="p-6">{{$menu->quantity}}</td>
                                <td class="p-6">{{$menu->description}}</td>
                                <td class="p-6">{{"$ " . $menu->price . " COP"}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </main>
        </div>

        @stack('modals')
        {{-- scrips --}}
        @livewireScripts
    </body>
</html>


