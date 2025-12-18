<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $web_settings->site_name ?? 'LMS Pro' }}</title>
    
    @if(isset($web_settings) && $web_settings->site_favicon)
        <link rel="icon" href="{{ $web_settings->site_favicon }}">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Outfit:wght@500;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-heading { font-family: 'Outfit', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans text-slate-600 antialiased bg-slate-50 flex flex-col min-h-screen">

    <div class="bg-slate-900 text-slate-300 text-xs py-2 relative z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="flex items-center space-x-6">
                <a href="#" class="hover:text-white transition flex items-center gap-2">
                    <i class="fas fa-phone-alt text-indigo-400"></i> <span>+51 999 999 999</span>
                </a>
                <a href="#" class="hidden sm:flex hover:text-white transition items-center gap-2">
                    <i class="fas fa-envelope text-indigo-400"></i> <span>soporte@lmspro.com</span>
                </a>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex space-x-3">
                    <a href="#" class="hover:text-white transition"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="hover:text-white transition"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="hover:text-white transition"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="hover:text-white transition"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>

    <header x-data="{ scrolled: false, mobileMenu: false }" 
            @scroll.window="scrolled = (window.pageYOffset > 20)"
            :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-md py-2' : 'bg-white/10 backdrop-blur-sm border-b border-white/10 py-4'"
            class="sticky top-0 w-full z-40 transition-all duration-300">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                        @if(isset($web_settings) && $web_settings->site_logo)
                            <img class="h-10 w-auto" src="{{ $web_settings->site_logo }}" alt="Logo">
                        @else
                            <div class="bg-indigo-600 text-white p-1.5 rounded-lg font-bold text-xl shadow-lg">LMS</div>
                            <span :class="scrolled ? 'text-slate-800' : 'text-white'" class="text-2xl font-heading font-extrabold tracking-tight transition-colors drop-shadow-md">PRO</span>
                        @endif
                    </a>
                </div>

                <nav class="hidden md:flex space-x-8 items-center">
                    @foreach(['Inicio' => 'home', 'Cursos' => 'courses.index'] as $label => $route)
                        <a href="{{ route($route) }}" 
                        :class="scrolled ? 'text-slate-700 hover:text-indigo-600' : 'text-white hover:text-indigo-200'"
                        class="font-heading font-bold text-sm tracking-wide uppercase transition-colors relative group">
                            {{ $label }}
                            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-indigo-600 transition-all duration-300 group-hover:w-full"></span>
                        </a>
                    @endforeach

                    <a href="{{ route('teachers.index') }}" 
                    :class="scrolled ? 'text-slate-700 hover:text-indigo-600' : 'text-white hover:text-indigo-200'" 
                    class="font-heading font-bold text-sm tracking-wide uppercase transition-colors group relative">
                        Docentes
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-indigo-600 transition-all duration-300 group-hover:w-full"></span>
                    </a>

                    @guest
                        <div class="flex items-center gap-3 ml-4">
                            <a href="{{ route('login') }}" 
                            :class="scrolled ? 'text-slate-600 hover:text-indigo-600' : 'text-white hover:text-indigo-200'"
                            class="font-bold text-sm transition">
                                Ingresar
                            </a>
                            <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-full font-bold text-xs shadow-lg hover:shadow-indigo-500/30 transform hover:-translate-y-0.5 transition duration-300 uppercase tracking-wider">
                                ¡Únete Gratis!
                            </a>
                        </div>
                    @else
                        <div class="ml-4 relative" x-data="{ open: false }">
                            <div>
                                <button @click="open = !open" type="button" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-indigo-500 transition shadow-lg">
                                    <img class="h-9 w-9 rounded-full object-cover border border-slate-600" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            </div>

                            <div x-show="open" 
                                @click.away="open = false" 
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="origin-top-right absolute right-0 mt-2 w-56 rounded-xl shadow-2xl bg-white ring-1 ring-black ring-opacity-5 z-50 divide-y divide-gray-100" 
                                style="display: none;">
                                
                                <div class="px-4 py-3">
                                    <p class="text-xs text-gray-500">Conectado como</p>
                                    <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                                </div>

                                <div class="py-1">
                                    <a href="{{ route('student.my-courses') }}" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">
                                        <i class="fas fa-graduation-cap mr-3 text-gray-400 group-hover:text-indigo-500"></i>
                                        Mis Cursos
                                    </a>
                                    <a href="{{ route('profile.show') }}" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">
                                        <i class="fas fa-user-cog mr-3 text-gray-400 group-hover:text-indigo-500"></i>
                                        Mi Perfil
                                    </a>
                                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'instructor')
                                        <a href="{{ route('dashboard') }}" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">
                                            <i class="fas fa-tachometer-alt mr-3 text-gray-400 group-hover:text-indigo-500"></i>
                                            Panel Administrativo
                                        </a>
                                    @endif
                                </div>

                                <div class="py-1">
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf
                                        <a href="{{ route('logout') }}"
                                        @click.prevent="$root.submit();"
                                        class="group flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                            <i class="fas fa-sign-out-alt mr-3 text-red-400 group-hover:text-red-600"></i>
                                            Cerrar Sesión
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endguest
                </nav>

                <button @click="mobileMenu = !mobileMenu" 
                        :class="scrolled ? 'text-slate-800' : 'text-white'"
                        class="md:hidden focus:outline-none transition-colors p-2">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>

        <div x-show="mobileMenu" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             x-cloak 
             class="md:hidden bg-white border-t border-gray-100 shadow-xl absolute w-full left-0 top-full">
            
            <div class="px-4 pt-4 pb-6 space-y-2">
                <a href="{{ route('home') }}" class="block px-4 py-3 rounded-lg text-slate-700 font-bold hover:bg-indigo-50">Inicio</a>
                <a href="{{ route('courses.index') }}" class="block px-4 py-3 rounded-lg text-slate-700 font-bold hover:bg-indigo-50">Cursos</a>
                <a href="{{ route('teachers.index') }}" class="block px-4 py-3 rounded-lg text-slate-700 font-bold hover:bg-indigo-50">Docentes</a>
                
                <hr class="border-gray-100 my-2">
                
                @guest
                    <a href="{{ route('login') }}" class="block w-full text-center px-4 py-3 rounded-lg border border-slate-200 text-slate-700 font-bold mb-2">Ingresar</a>
                    <a href="{{ route('register') }}" class="block w-full text-center px-4 py-3 rounded-lg bg-indigo-600 text-white font-bold">Registrarse</a>
                @else
                    <div class="px-4 py-2 bg-indigo-50 rounded-lg mb-2">
                        <p class="text-xs text-indigo-500 font-bold uppercase">Tu Cuenta</p>
                        <p class="text-sm font-bold text-slate-800">{{ Auth::user()->name }}</p>
                    </div>
                    <a href="{{ route('student.my-courses') }}" class="block px-4 py-2 rounded-lg text-slate-700 hover:bg-indigo-50">Mis Cursos</a>
                    <a href="{{ route('profile.show') }}" class="block px-4 py-2 rounded-lg text-slate-700 hover:bg-indigo-50">Mi Perfil</a>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left block px-4 py-2 rounded-lg text-red-600 hover:bg-red-50 font-bold">Cerrar Sesión</button>
                    </form>
                @endguest
            </div>
        </div>
    </header>

    <div class="-mt-[88px] flex-grow">
        {{ $slot }}
    </div>

    <footer class="bg-slate-950 text-slate-400 pt-20 pb-10 border-t border-slate-900 font-sans relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                
                <div>
                    <div class="mb-6">
                        <span class="text-3xl font-heading font-extrabold text-white">LMS<span class="text-indigo-500">PRO</span></span>
                    </div>
                    <p class="text-sm leading-relaxed mb-6 text-slate-400">
                        La plataforma líder en educación online. Conectamos estudiantes con los mejores instructores del mundo para transformar carreras.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-900 flex items-center justify-center text-white hover:bg-indigo-600 hover:-translate-y-1 transition duration-300 border border-slate-800"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-900 flex items-center justify-center text-white hover:bg-sky-500 hover:-translate-y-1 transition duration-300 border border-slate-800"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-900 flex items-center justify-center text-white hover:bg-pink-600 hover:-translate-y-1 transition duration-300 border border-slate-800"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>

                <div>
                    <h4 class="text-white font-bold text-lg mb-6 font-heading">Explorar</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-indigo-400 transition flex items-center gap-2"><i class="fas fa-chevron-right text-xs text-slate-600"></i> Inicio</a></li>
                        <li><a href="{{ route('courses.index') }}" class="hover:text-indigo-400 transition flex items-center gap-2"><i class="fas fa-chevron-right text-xs text-slate-600"></i> Todos los Cursos</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition flex items-center gap-2"><i class="fas fa-chevron-right text-xs text-slate-600"></i> Docentes</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition flex items-center gap-2"><i class="fas fa-chevron-right text-xs text-slate-600"></i> Blog & Noticias</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-bold text-lg mb-6 font-heading">Soporte</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="hover:text-indigo-400 transition">Centro de Ayuda</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition">Términos y Condiciones</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition">Política de Privacidad</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition">Contacto</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-bold text-lg mb-6 font-heading">Mantente al día</h4>
                    <p class="text-xs text-slate-500 mb-4">Suscríbete para recibir ofertas exclusivas y novedades de cursos.</p>
                    <form class="space-y-3">
                        <input type="email" placeholder="Tu correo electrónico" class="w-full bg-slate-900 border border-slate-800 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm placeholder-slate-600">
                        <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-lg transition text-sm uppercase tracking-wide">
                            Suscribirse
                        </button>
                    </form>
                </div>
            </div>

            <div class="border-t border-slate-900 pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-slate-500 text-center md:text-left">
                <p>&copy; {{ date('Y') }} {{ $web_settings->site_name ?? 'LMS Pro' }}. Desarrollado con Laravel 12 & Livewire.</p>
                <div class="mt-4 md:mt-0 flex space-x-6 justify-center">
                    <span class="flex items-center gap-2"><i class="fas fa-shield-alt"></i> Pagos Seguros</span>
                    <span class="flex items-center gap-2"><i class="fas fa-globe"></i> Español</span>
                </div>
            </div>
        </div>
    </footer>

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true, offset: 50 });
    </script>
</body>
</html>