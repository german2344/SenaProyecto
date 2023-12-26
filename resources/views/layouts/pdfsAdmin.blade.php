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
                {{$slot}}
            </main>
        </div>

        @stack('modals')
        {{-- scrips --}}
        @livewireScripts
    </body>
</html>
