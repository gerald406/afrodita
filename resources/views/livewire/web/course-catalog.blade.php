<div>
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        
        <div class="hidden lg:block lg:col-span-1 space-y-8">
            
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <h4 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-search text-indigo-500"></i> Buscar
                </h4>
                <div class="relative group">
                    <input wire:model.live.debounce.300ms="search" 
                           type="text" 
                           placeholder="Buscar curso..." 
                           class="w-full bg-slate-50 text-slate-700 text-sm rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 pl-10 py-3 transition-all">
                    <div class="absolute left-3 top-3.5 text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="font-bold text-slate-800 flex items-center gap-2">
                        <i class="fas fa-th-large text-indigo-500"></i> Categorías
                    </h4>
                    @if($category)
                        <button wire:click="$set('category', '')" class="text-xs text-red-500 hover:underline">Limpiar</button>
                    @endif
                </div>

                <ul class="space-y-2">
                    @foreach($categories as $cat)
                        <li>
                            <button wire:click="$set('category', '{{ $cat->slug }}')" 
                                    class="w-full flex justify-between items-center px-3 py-2 rounded-lg transition-colors text-sm
                                    {{ $category == $cat->slug ? 'bg-indigo-50 text-indigo-700 font-bold shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                                <span>{{ $cat->name }}</span>
                                <span class="text-xs px-2 py-0.5 rounded-full {{ $category == $cat->slug ? 'bg-indigo-100 text-indigo-700' : 'bg-slate-100 text-slate-500' }}">
                                    {{ $cat->courses_count }}
                                </span>
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="relative rounded-2xl overflow-hidden shadow-lg group">
                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="w-full h-64 object-cover transform group-hover:scale-110 transition duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent flex flex-col justify-end p-6">
                    <span class="text-yellow-400 font-bold text-xs uppercase tracking-wider mb-1">Oferta Especial</span>
                    <h5 class="text-white font-bold text-lg leading-tight mb-3">50% Dcto. en Plan Premium</h5>
                </div>
            </div>
        </div>

        <div class="lg:col-span-3">
            
            <div class="flex flex-col sm:flex-row justify-between items-center mb-8 bg-white p-4 rounded-xl border border-slate-100 shadow-sm relative overflow-hidden">
                
                <div wire:loading class="absolute top-0 left-0 w-full h-1 bg-indigo-100 overflow-hidden">
                    <div class="h-full bg-indigo-500 animate-progress"></div>
                </div>

                <p class="text-slate-500 text-sm mb-4 sm:mb-0">
                    Mostrando <span class="font-bold text-slate-800">{{ $courses->firstItem() ?? 0 }}-{{ $courses->lastItem() ?? 0 }}</span> de <span class="font-bold text-slate-800">{{ $courses->total() }}</span> cursos
                </p>
                
                <div class="flex items-center gap-3">
                    <label for="sort" class="text-sm text-slate-500">Ordenar:</label>
                    <select wire:model.live="sort" id="sort" class="bg-slate-50 border-slate-200 text-slate-700 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 p-2 cursor-pointer">
                        <option value="newest">Más Recientes</option>
                        <option value="popular">Más Populares</option>
                        <option value="price_asc">Precio: Bajo a Alto</option>
                        <option value="price_desc">Precio: Alto a Bajo</option>
                    </select>
                </div>
            </div>

            @if($courses->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 relative">
                    <div wire:loading.flex class="absolute inset-0 bg-white/50 z-10 flex items-center justify-center backdrop-blur-sm rounded-xl">
                        <div class="animate-spin rounded-full h-12 w-12 border-4 border-indigo-500 border-t-transparent"></div>
                    </div>

                    @foreach($courses as $course)
                        <x-course-card :course="$course" />
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $courses->links() }} 
                </div>
            @else
                <div class="text-center py-20 bg-white rounded-2xl border border-dashed border-slate-200">
                    <div class="bg-indigo-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 text-indigo-500 text-3xl">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800">No encontramos cursos</h3>
                    <p class="text-slate-500 mb-6">No hay resultados para tu búsqueda o filtros actuales.</p>
                    <button wire:click="resetFilters" class="text-indigo-600 font-bold hover:underline">
                        Limpiar todos los filtros
                    </button>
                </div>
            @endif
        </div>
    </div>
    
    <script>
        // Animación simple para la barra de carga
        tailwind.config = {
            theme: {
                extend: {
                    keyframes: {
                        progress: {
                            '0%': { transform: 'translateX(-100%)' },
                            '100%': { transform: 'translateX(100%)' },
                        }
                    },
                    animation: {
                        progress: 'progress 1s infinite linear',
                    }
                }
            }
        }
    </script>
</div>