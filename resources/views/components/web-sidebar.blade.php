<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
       class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r border-gray-100 shadow-2xl lg:shadow-none lg:static lg:inset-auto lg:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col shrink-0">
    
    <div class="h-20 flex items-center px-8 border-b border-gray-50 bg-white">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            @if(isset($web_settings) && $web_settings->site_logo)
                <img src="{{ asset($web_settings->site_logo) }}" alt="{{ $web_settings->site_name }}" class="h-10 w-auto object-contain">
            @else
                <div class="w-8 h-8 bg-gradient-to-br from-red-500 to-orange-500 rounded-lg flex items-center justify-center text-white font-bold text-lg shadow-lg shadow-red-200">
                    {{ substr($web_settings->site_name ?? 'A', 0, 1) }}
                </div>
                <span class="font-extrabold text-xl text-slate-800 tracking-tight">
                    {{ $web_settings->site_name ?? 'Afrodita' }}<span class="text-red-500">.</span>
                </span>
            @endif
        </a>
        <button @click="sidebarOpen = false" class="lg:hidden ml-auto text-slate-400 hover:text-red-500">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>

    <div class="flex-1 overflow-y-auto custom-scrollbar py-6 px-4 space-y-8">
        
        <div>
            <h3 class="px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Menu Principal</h3>
            <nav class="space-y-1">
                <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('home') && !request('category') ? 'bg-red-50 text-red-600 font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-medium' }} transition-colors">
                    <i class="fas fa-home {{ request()->routeIs('home') && !request('category') ? 'text-red-500' : 'text-slate-400' }} w-5 text-center"></i>
                    <span>Inicio</span>
                </a>
                <a href="{{ route('courses.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('courses.index') ? 'bg-red-50 text-red-600 font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-medium' }} transition-colors">
                    <i class="fas fa-compass {{ request()->routeIs('courses.index') ? 'text-red-500' : 'text-slate-400' }} w-5 text-center"></i>
                    <span>Catálogo</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-medium transition-colors">
                    <i class="fas fa-chalkboard-teacher text-slate-400 w-5 text-center"></i>
                    <span>Docentes</span>
                </a>
            </nav>
        </div>

        <div>
            <h3 class="px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Especialidades</h3>
            <nav class="space-y-1">
                @foreach($globalCategories as $category)
                    <a href="{{ route('home', ['category' => $category->id]) }}" 
                       class="flex items-center justify-between px-4 py-2.5 rounded-xl {{ request('category') == $category->id ? 'bg-red-50 text-red-600 font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 text-sm font-medium' }} transition-colors group">
                        <div class="flex items-center gap-3">
                            <span class="w-6 h-6 rounded-md {{ request('category') == $category->id ? 'bg-red-100 text-red-500' : 'bg-slate-100 text-slate-400 group-hover:bg-white group-hover:text-red-500 group-hover:shadow-sm' }} flex items-center justify-center text-xs transition-all">
                                <i class="{{ $category->icon ?? 'fas fa-book' }}"></i>
                            </span>
                            <span>{{ $category->name }}</span>
                        </div>
                        @if(request('category') == $category->id)
                            <i class="fas fa-chevron-right text-[10px]"></i>
                        @endif
                    </a>
                @endforeach
            </nav>
        </div>

        @guest
            <div class="pt-4 border-t border-gray-100">
                <h3 class="px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Mi Cuenta</h3>
                <nav class="space-y-2">
                    
                    {{-- 1. Iniciar Sesión --}}
                    <a href="{{ route('login') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-700 hover:bg-red-50 hover:text-red-600 font-bold transition-colors group">
                        <div class="w-8 h-8 rounded-full bg-slate-100 group-hover:bg-white group-hover:text-red-500 flex items-center justify-center text-slate-500 border border-slate-200 transition-colors">
                            <i class="fas fa-sign-in-alt text-xs"></i>
                        </div>
                        <span class="text-sm">Iniciar Sesión</span>
                    </a>

                    {{-- 2. Crear Cuenta --}}
                    <a href="{{ route('register') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-700 hover:bg-red-50 hover:text-red-600 font-bold transition-colors group">
                        <div class="w-8 h-8 rounded-full bg-slate-100 group-hover:bg-white group-hover:text-red-500 flex items-center justify-center text-slate-500 border border-slate-200 transition-colors">
                            <i class="fas fa-user-plus text-xs"></i>
                        </div>
                        <span class="text-sm">Crear Cuenta</span>
                    </a>

                    {{-- 3. Olvidé contraseña --}}
                    <a href="{{ route('password.request') }}" class="flex items-center gap-3 px-4 py-2 rounded-xl text-slate-400 hover:text-slate-600 text-xs font-medium transition-colors ml-1">
                        <i class="fas fa-key text-[10px]"></i>
                        <span>¿Olvidaste tu contraseña?</span>
                    </a>
                </nav>
            </div>
        @endguest

    </div>

    <div class="p-4 bg-white border-t border-gray-50">
        <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-2xl p-4 relative overflow-hidden group shadow-lg">
            <div class="absolute top-0 right-0 -mt-2 -mr-2 w-16 h-16 bg-red-500 rounded-full blur-2xl opacity-20 group-hover:opacity-40 transition"></div>
            <h4 class="text-white font-bold text-sm mb-1 relative z-10">¿Eres docente?</h4>
            <p class="text-slate-400 text-xs mb-3 relative z-10">Crea y vende tus cursos hoy.</p>
            <a href="#" class="inline-block w-full text-center bg-white/10 hover:bg-white/20 border border-white/10 text-white text-xs font-bold py-2 rounded-lg transition backdrop-blur-sm">
                Comenzar ahora
            </a>
        </div>
    </div>
</aside>