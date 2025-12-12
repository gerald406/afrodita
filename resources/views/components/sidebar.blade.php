<aside 
    :class="sidebarCollapsed ? 'w-20' : 'w-64'"
    class="flex-shrink-0 bg-slate-900 border-r border-gray-800 shadow-xl hidden md:flex md:flex-col transition-all duration-300 ease-in-out relative z-20">
    
    <div class="flex items-center h-16 bg-slate-800 border-b border-gray-700 px-4 transition-all duration-300"
         :class="sidebarCollapsed ? 'justify-center' : 'justify-between'">
        
        <span x-show="!sidebarCollapsed" 
              class="text-white font-bold text-lg tracking-wider whitespace-nowrap overflow-hidden transition-opacity duration-200">
            LMS ADMIN
        </span>

        <button @click="toggleCollapse()" 
                class="text-gray-400 hover:text-white focus:outline-none transition-colors duration-200 p-1 rounded-md hover:bg-slate-700">
            <i class="fas fa-bars text-lg"></i>
        </button>
    </div>

    <div class="flex-1 overflow-y-auto py-4 overflow-x-hidden">
        <nav class="space-y-2 px-3">
            
            <a href="{{ route('dashboard') }}" 
               class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors duration-200
                      {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-md' : 'text-gray-300 hover:bg-slate-800 hover:text-white' }}">
                <i class="fas fa-gauge-high text-lg w-6 text-center transition-transform group-hover:scale-110 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}"></i>
                
                <span x-show="!sidebarCollapsed" class="ml-3 whitespace-nowrap transition-opacity duration-200">
                    Dashboard
                </span>
            </a>

            @if(Auth::user()->isAdmin())
                
                <div x-show="!sidebarCollapsed" class="mt-6 mb-2 px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider transition-opacity duration-200">
                    Gestión
                </div>
                <div x-show="sidebarCollapsed" class="my-4 border-t border-gray-700 mx-2"></div>

                <a href="#" class="group flex items-center px-3 py-3 text-sm font-medium text-gray-300 rounded-lg hover:bg-slate-800 hover:text-white transition-colors duration-200">
                    <i class="fas fa-book-open text-lg w-6 text-center text-gray-400 group-hover:text-white transition-transform group-hover:scale-110"></i>
                    <span x-show="!sidebarCollapsed" class="ml-3 whitespace-nowrap">Cursos</span>
                </a>

                <a href="#" class="group flex items-center px-3 py-3 text-sm font-medium text-gray-300 rounded-lg hover:bg-slate-800 hover:text-white transition-colors duration-200">
                    <i class="fas fa-users text-lg w-6 text-center text-gray-400 group-hover:text-white transition-transform group-hover:scale-110"></i>
                    <span x-show="!sidebarCollapsed" class="ml-3 whitespace-nowrap">Usuarios</span>
                </a>

                <a href="#" class="group flex items-center px-3 py-3 text-sm font-medium text-gray-300 rounded-lg hover:bg-slate-800 hover:text-white transition-colors duration-200">
                    <i class="fas fa-graduation-cap text-lg w-6 text-center text-gray-400 group-hover:text-white transition-transform group-hover:scale-110"></i>
                    <span x-show="!sidebarCollapsed" class="ml-3 whitespace-nowrap">Matrículas</span>
                </a>

                <div x-show="!sidebarCollapsed" class="mt-6 mb-2 px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    Sistema
                </div>
                <div x-show="sidebarCollapsed" class="my-4 border-t border-gray-700 mx-2"></div>

                <a href="#" class="group flex items-center px-3 py-3 text-sm font-medium text-gray-300 rounded-lg hover:bg-slate-800 hover:text-white transition-colors duration-200">
                    <i class="fas fa-gear text-lg w-6 text-center text-gray-400 group-hover:text-white transition-transform group-hover:scale-110"></i>
                    <span x-show="!sidebarCollapsed" class="ml-3 whitespace-nowrap">Ajustes</span>
                </a>
            @endif

            @if(Auth::user()->isStudent())
                <div x-show="!sidebarCollapsed" class="mt-6 mb-2 px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    Aprendizaje
                </div>
                <div x-show="sidebarCollapsed" class="my-4 border-t border-gray-700 mx-2"></div>

                <a href="#" class="group flex items-center px-3 py-3 text-sm font-medium text-gray-300 rounded-lg hover:bg-slate-800 hover:text-white transition-colors duration-200">
                    <i class="fas fa-laptop-code text-lg w-6 text-center text-gray-400 group-hover:text-white transition-transform group-hover:scale-110"></i>
                    <span x-show="!sidebarCollapsed" class="ml-3 whitespace-nowrap">Mis Cursos</span>
                </a>
            @endif

        </nav>
    </div>
    
    <div class="border-t border-gray-800 p-4 bg-slate-800">
        <div class="flex items-center" :class="sidebarCollapsed ? 'justify-center' : ''">
            <div class="flex-shrink-0">
                <img class="h-9 w-9 rounded-full object-cover border-2 border-slate-600" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
            </div>
            <div class="ml-3" x-show="!sidebarCollapsed">
                <p class="text-sm font-medium text-white truncate w-32">{{ Auth::user()->name }}</p>
                <a href="{{ route('profile.show') }}" class="text-xs font-medium text-gray-400 hover:text-gray-200">Ver Perfil</a>
            </div>
        </div>
    </div>
</aside>