<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $web_settings->site_name ?? 'Afrodita LMS' }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        body { font-family: 'Inter', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 text-slate-600 font-sans antialiased h-screen flex overflow-hidden selection:bg-red-100 selection:text-red-600" 
      x-data="{ sidebarOpen: false }">

    {{-- Lógica para determinar si ocultamos el Sidebar --}}
    @php
        $hideSidebar = request()->routeIs('courses.index', 'courses.show');
    @endphp

    @unless($hideSidebar)
        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity 
             class="fixed inset-0 bg-slate-900/50 z-40 lg:hidden backdrop-blur-sm"></div>

        <x-web-sidebar />
    @endunless

    <div class="flex-1 flex flex-col h-screen overflow-hidden relative w-full transition-all duration-300">
        
        <header class="h-20 bg-white/80 backdrop-blur-md border-b border-gray-100 flex items-center justify-between px-4 md:px-8 py-4 shrink-0 z-30 sticky top-0">
            
            @if(!$hideSidebar)
                <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-slate-500 hover:text-red-600 p-2 mr-2">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            @else
                <a href="{{ route('home') }}" class="flex items-center gap-2 mr-4 md:mr-8 shrink-0">
                    @if(isset($web_settings) && $web_settings->site_logo)
                        <img src="{{ asset($web_settings->site_logo) }}" alt="{{ $web_settings->site_name }}" class="h-10 w-auto object-contain">
                    @else
                        <div class="w-8 h-8 bg-gradient-to-br from-red-500 to-orange-500 rounded-lg flex items-center justify-center text-white font-bold text-lg shadow-lg shadow-red-200">
                            {{ substr($web_settings->site_name ?? 'A', 0, 1) }}
                        </div>
                        <span class="font-extrabold text-xl text-slate-800 tracking-tight hidden md:block">
                            {{ $web_settings->site_name ?? 'Afrodita' }}<span class="text-red-500">.</span>
                        </span>
                    @endif
                </a>
            @endif

            <div class="flex-1 max-w-2xl mr-4 md:mx-auto relative group">
                <form action="{{ route('courses.index') }}" method="GET">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400 group-focus-within:text-red-500 transition-colors"></i>
                        </div>
                        {{-- Mantenemos el valor de búsqueda si existe --}}
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="¿Qué quieres aprender hoy?" 
                               class="w-full bg-slate-100 border-none rounded-2xl py-3 pl-11 pr-4 text-sm focus:ring-2 focus:ring-red-100 focus:bg-white transition-all shadow-sm placeholder-slate-400 text-slate-700">
                    </div>
                </form>
            </div>

            <div class="flex items-center gap-3 md:gap-6">
                @guest
                    <a href="{{ route('login') }}" class="hidden md:flex items-center gap-2 text-slate-600 font-bold hover:text-red-600 transition text-sm">
                        Ingresar
                    </a>
                    <a href="{{ route('register') }}" class="bg-red-600 text-white hover:bg-red-700 font-bold py-2.5 px-4 md:px-6 rounded-full transition shadow-lg shadow-red-200 text-sm whitespace-nowrap transform hover:-translate-y-0.5">
                        <span class="hidden md:inline">Crear Cuenta</span>
                        <span class="md:hidden">Registro</span>
                    </a>
                @else
                    <div class="relative ml-3" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-3 focus:outline-none">
                            <img class="h-10 w-10 rounded-full object-cover border-2 border-white shadow-sm" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            <div class="hidden md:block text-left">
                                <p class="text-xs font-bold text-slate-700">{{ Auth::user()->name }}</p>
                                <p class="text-[10px] text-slate-400 uppercase tracking-wider">{{ Auth::user()->role_name ?? 'Estudiante' }}</p>
                            </div>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl py-2 z-50 border border-gray-100">
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600">Mi Panel</a>
                            @if(Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <a href="{{ route('api-tokens.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600">API Tokens</a>
                            @endif
                            <div class="border-t border-gray-100 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600">Cerrar Sesión</button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-4 md:p-8 scroll-smooth custom-scrollbar bg-slate-50/50">
            {{ $slot }}
            
            <footer class="mt-20 py-8 border-t border-gray-200 text-center text-slate-400 text-xs">
                <p>&copy; {{ date('Y') }} {{ $web_settings->site_name ?? 'Afrodita LMS' }}. Todos los derechos reservados.</p>
            </footer>
        </main>

    </div>

    <div class="fixed bottom-6 right-6 z-50 flex flex-col gap-4">
        <a href="https://wa.me/" target="_blank" class="w-12 h-12 md:w-14 md:h-14 bg-[#25D366] rounded-full shadow-lg shadow-green-200 flex items-center justify-center text-white text-2xl md:text-3xl hover:scale-110 transition border-4 border-white group relative">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>
</html>