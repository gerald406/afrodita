<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $web_settings->site_name ?? 'EducaAuge Clone' }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Ocultar barra de desplazamiento del sidebar pero permitir scroll */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-50 text-slate-600 font-sans antialiased h-screen flex overflow-hidden">

    <x-web-sidebar />

    <div class="flex-1 flex flex-col h-screen overflow-hidden relative">
        
        <header class="h-20 bg-white border-b border-gray-100 flex items-center justify-between px-8 py-4 shrink-0 z-20">
            
            <div class="flex-1 max-w-3xl mx-auto px-4">
                <form action="{{ route('courses.index') }}" method="GET" class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400 group-focus-within:text-red-500 transition"></i>
                    </div>
                    <input type="text" 
                           name="search" 
                           placeholder="Busca tu curso" 
                           class="w-full bg-gray-100 border-none rounded-full py-3 pl-10 pr-4 text-sm focus:ring-2 focus:ring-red-100 focus:bg-white transition placeholder-gray-500 text-gray-700">
                </form>
            </div>

            <div class="ml-4 flex items-center gap-4">
                @guest
                    <a href="{{ route('login') }}" class="flex items-center gap-2 border border-red-500 text-red-600 hover:bg-red-50 font-bold py-2 px-6 rounded-full transition text-sm">
                        <i class="fas fa-user-circle text-lg"></i>
                        ACCEDER
                    </a>
                @else
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-bold text-gray-700">{{ Auth::user()->name }}</span>
                        <img src="{{ Auth::user()->profile_photo_url }}" class="w-10 h-10 rounded-full border border-gray-200">
                    </div>
                @endguest
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-6 md:p-8 scroll-smooth">
            {{ $slot }}
        </main>

    </div>

    <div class="fixed bottom-6 right-6 z-50 flex flex-col gap-3">
        <a href="#" class="w-14 h-14 bg-[#25D366] rounded-full shadow-lg flex items-center justify-center text-white text-3xl hover:scale-110 transition border-4 border-white">
            <i class="fab fa-whatsapp"></i>
        </a>
        <a href="#" class="w-14 h-14 bg-yellow-400 rounded-full shadow-lg flex items-center justify-center text-white text-2xl hover:scale-110 transition border-4 border-white">
            <i class="fas fa-phone"></i>
        </a>
        {{-- <a href="#" class="w-14 h-14 bg-blue-600 rounded-full shadow-lg flex items-center justify-center text-white text-2xl hover:scale-110 transition border-4 border-white animate-bounce">
            <i class="fas fa-info"></i>
        </a> --}}
    </div>
    
    {{-- <div class="fixed bottom-6 left-6 z-50 md:left-72"> <div class="bg-red-500 text-white rounded-full p-4 shadow-lg hover:scale-105 transition cursor-pointer flex items-center gap-3">
            <div class="bg-white/20 rounded-full p-2">
                <i class="fas fa-comment-dots text-2xl"></i>
            </div>
            <div class="hidden md:block pr-2">
                <p class="text-xs font-bold">¡Hola! ¿Tienes alguna</p>
                <p class="text-xs">pregunta?</p>
            </div>
        </div>
    </div> --}}

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>
</html>