<aside class="w-72 bg-white border-r border-gray-200 hidden md:flex flex-col h-full shrink-0 overflow-y-auto no-scrollbar py-6 px-4">
    
    <div class="mb-8 px-2">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <div class="bg-red-600 text-white p-1.5 rounded-lg font-bold text-xl shadow-lg">G</div>
             <span class="font-extrabold text-2xl tracking-tight text-slate-800">GRUPO <span class="text-red-600">AUGE</span></span>
        </a>
    </div>

    <nav class="space-y-6 flex-1">
        
        <div>
            <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('home') && !request('category') ? 'bg-red-50 text-red-600 font-bold' : 'text-slate-600 hover:bg-gray-50' }} rounded-xl transition">
                <i class="fas fa-home w-5 text-center"></i>
                Inicio
            </a>
        </div>

        <div>
            <h3 class="px-4 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Tu</h3>
            <ul class="space-y-1">
                @guest
                    <li>
                        <a href="{{ route('login') }}" class="flex items-center gap-3 px-4 py-2 text-sm font-medium text-slate-600 hover:text-red-600 hover:bg-gray-50 rounded-lg transition">
                            <i class="fas fa-sign-in-alt w-5 text-center"></i> Iniciar sesión
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" class="flex items-center gap-3 px-4 py-2 text-sm font-medium text-slate-600 hover:text-red-600 hover:bg-gray-50 rounded-lg transition">
                            <i class="fas fa-user-plus w-5 text-center"></i> Crear cuenta
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('profile.show') }}" class="flex items-center gap-3 px-4 py-2 text-sm font-medium text-slate-600 hover:text-red-600 hover:bg-gray-50 rounded-lg transition">
                            <i class="fas fa-user-circle w-5 text-center"></i> Mi Perfil
                        </a>
                    </li>
                @endguest
            </ul>
        </div>

        <div>
            <h3 class="px-4 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Tipo</h3>
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('courses.index') }}" class="flex items-center gap-3 px-4 py-2 text-sm font-medium text-slate-600 hover:text-red-600 hover:bg-gray-50 rounded-lg transition">
                        <i class="fas fa-book-open w-5 text-center"></i> Cursos
                    </a>
                </li>
            </ul>
        </div>
        
        <div>
             <h3 class="px-4 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Categorías</h3>
             <ul class="space-y-1">
                @forelse($globalCategories as $cat)
                    <li>
                        <a href="{{ route('home', ['category' => $cat->id]) }}" 
                           class="flex items-center gap-3 px-4 py-2 text-sm font-medium rounded-lg transition
                           {{ request('category') == $cat->id ? 'bg-orange-50 text-orange-600 font-bold' : 'text-slate-600 hover:text-orange-500 hover:bg-gray-50' }}">
                            <span class="w-2 h-2 rounded-full {{ ['bg-red-400', 'bg-blue-400', 'bg-green-400', 'bg-yellow-400'][($loop->index % 4)] }}"></span>
                            {{ $cat->name }}
                        </a>
                    </li>
                @empty
                    <li class="px-4 py-2 text-xs text-slate-400 italic">No hay categorías</li>
                @endforelse
             </ul>
        </div>

    </nav>
</aside>