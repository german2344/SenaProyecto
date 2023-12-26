<header class="header">
    <div href="#" class="logo">
        <img src="{{asset('favicons/LogoSenakicht.png')}}" alt="logo">
    </div>
    <nav class="navbar">
        <a wire:navigate class="px-2 {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}"><i class="fas fa-home fa-fw"></i> Inicio</a>
        <a wire:navigate class="px-2 {{ request()->routeIs('nosotros') ? 'active' : '' }}" href="{{ route('nosotros') }}"><i class="fas fa-info-circle fa-fw"></i> Acerca de</a>
        <a wire:navigate class="px-2 {{ request()->routeIs('menu') ? 'active' : '' }}" href="{{ route('menu') }}"><i class="fas fa-utensils fa-fw"></i> Platos</a>
        <a wire:navigate class="px-2 {{ request()->routeIs('productos') ? 'active' : '' }}" href="{{ route('productos') }}"><i class="fas fa-shopping-basket fa-fw"></i> Productos</a>
        <a wire:navigate class="px-2 {{ request()->routeIs('recetas') ? 'active' : '' }}" href="{{ route('recetas') }}"><i class="fas fa-book-open fa-fw"></i> Recetas</a>
        <a wire:navigate class="px-2 {{ request()->routeIs('comentarios.index') ? 'active' : '' }}" href="{{ route('comentarios.index') }}"><i class="fas fa-comments fa-fw"></i> Opiniones</a>
        <a wire:navigate class="px-2 {{ request()->routeIs('contactos') ? 'active' : '' }}" href="{{ route('contactos') }}"><i class="fas fa-envelope fa-fw"></i> Contacto</a>
    </nav>
    <div class="cont-header-iconos" >
        <div  class="fas fa-search " id="search-btn"></div>
            @livewire('search-nav')
            @livewire('app.components.cart.mini-cart-detail')
            <div class="fas fa-bars mx-4 px-4" id="menu-btn"></div>
            <!--vista auth-->
            @if(auth()->check())
                <div class="ms-3 mx-4 relative" style="transform: scale(1.1);">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">

                                
                                
                                @if(Auth::user()->profile_photo_path ===null)
                                    <img src="{{Auth::user()->profile_photo_url}}" alt="" class="h-10 w-10 rounded-full object-cover">
                                @elseif(strpos(Auth::user()->profile_photo_path, 'http') === 0)
                                    <img src="{{ Auth::user()->profile_photo_path}}" alt="" class="h-10 w-10 rounded-full object-cover">
                                @elseif(file_exists(public_path('storage/' . Auth::user()->profile_photo_path)))
                                    <img src="{{ asset('storage/' . Auth::user()->profile_photo_path)}}" alt="" class="h-10 w-10 rounded-full object-cover">
                                @endif
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}
        
                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>
        
                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Administrar Cuenta') }}
                            </div>
        
                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Perfil') }}
                            </x-dropdown-link>
        
                            <!-- url admin -->
                            @can('admin.home')
                                <x-dropdown-link href="{{ route('admin.home') }}">
                                    {{-- <i class="fas fa-cogs"></i>  --}}
                                    {{ __('Dashboard') }}
                                </x-dropdown-link>                
                            @endcan
        
                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif
        
                            <div class="border-t border-gray-200"></div>
        
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
        
                                <x-dropdown-link href="{{ route('logout') }}"
                                        @click.prevent="$root.submit();">
                                    {{ __('Cerrar Sesión') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
                
            @else
                <div class="flex items-center lg:order-2">
                    <x-dropdown width="48">
                        <x-slot name="trigger">
                            <i class="fas fa-fw fa-user"></i>
                        </x-slot>
        
                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Bienvenido a Senakitch') }}
                            </div>
        
                            <x-dropdown-link href="{{ route('register') }}">
                                {{ __('Registrarse') }}
                            </x-dropdown-link>
                            
                            <x-dropdown-link href="{{ route('login') }}">
                                {{ __('Iniciar sesión') }}
                            </x-dropdown-link>
        
        
                            <div class="border-t border-gray-200"></div>
                        </x-slot>
                    </x-dropdown>
                </div>
            @endif
    </div>
</header>