<div class="container mx-auto px-4 py-8">
    
    <div class="lg:hidden mb-6">
        <h1 class="text-2xl font-extrabold text-slate-900 mb-2">Catálogo</h1>
        <p class="text-slate-500 text-sm mb-4">Encuentra el curso perfecto para ti.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        
        <div class="hidden lg:block lg:col-span-1 space-y-8">
            
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
                <h4 class="font-bold text-slate-800 mb-3 text-sm uppercase tracking-wide">Buscar</h4>
                <div class="relative group">
                    <input wire:model.live.debounce.300ms="search" 
                           type="text" 
                           placeholder="Ej: Laravel, Diseño..." 
                           class="w-full bg-slate-50 text-slate-700 text-sm rounded-xl border-slate-200 focus:border-red-500 focus:ring-red-500 pl-9 py-2.5 transition-all">
                    <div class="absolute left-3 top-3 text-slate-400 group-focus-within:text-red-500 transition-colors">
                        <i class="fas fa-search text-xs"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="font-bold text-slate-800 text-sm uppercase tracking-wide">Categorías</h4>
                    @if($category)
                        <button wire:click="$set('category', '')" class="text-[10px] font-bold text-red-500 hover:underline bg-red-50 px-2 py-1 rounded">
                            LIMPIAR
                        </button>
                    @endif
                </div>

                <div class="space-y-1">
                    <label class="flex items-center justify-between cursor-pointer group p-2 rounded-lg hover:bg-slate-50 transition">
                        <div class="flex items-center gap-3">
                            <div class="relative flex items-center">
                                <input type="radio" wire:model.live="category" value="" class="peer sr-only">
                                <div class="w-4 h-4 border-2 border-slate-300 rounded-full peer-checked:border-red-500 peer-checked:bg-red-500 transition-all"></div>
                            </div>
                            <span class="text-sm text-slate-600 group-hover:text-slate-900 font-medium">Todas</span>
                        </div>
                    </label>

                    @foreach($categories as $cat)
                        <label class="flex items-center justify-between cursor-pointer group p-2 rounded-lg hover:bg-slate-50 transition">
                            <div class="flex items-center gap-3">
                                <div class="relative flex items-center">
                                    <input type="radio" wire:model.live="category" value="{{ $cat->id }}" class="peer sr-only">
                                    <div class="w-4 h-4 border-2 border-slate-300 rounded-full peer-checked:border-red-500 peer-checked:bg-red-500 transition-all"></div>
                                </div>
                                <span class="text-sm text-slate-600 group-hover:text-slate-900 {{ $category == $cat->id ? 'font-bold text-slate-900' : '' }}">
                                    {{ $cat->name }}
                                </span>
                            </div>
                            <span class="text-[10px] font-bold text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full group-hover:bg-white group-hover:text-red-500 transition">
                                {{ $cat->courses_count }}
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="relative rounded-2xl overflow-hidden shadow-lg group cursor-pointer">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent z-10"></div>
                <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="w-full h-64 object-cover transform group-hover:scale-110 transition duration-700">
                <div class="absolute bottom-0 left-0 p-5 z-20 text-white">
                    <span class="bg-yellow-400 text-slate-900 text-[10px] font-black px-2 py-1 rounded uppercase mb-2 inline-block">Premium</span>
                    <h5 class="font-bold text-lg leading-tight">Acceso ilimitado a todos los cursos</h5>
                </div>
            </div>
        </div>

        <div class="lg:col-span-3">
            
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 bg-white p-4 rounded-xl border border-slate-100 shadow-sm">
                <p class="text-slate-500 text-sm mb-4 sm:mb-0">
                    <span class="font-bold text-slate-900">{{ $courses->total() }}</span> cursos encontrados
                </p>
                
                <div class="flex items-center gap-3">
                    <span class="text-xs font-bold text-slate-400 uppercase">Ordenar:</span>
                    <select wire:model.live="sort" class="bg-slate-50 border-none text-slate-700 text-sm rounded-lg focus:ring-2 focus:ring-red-500 py-2 pl-3 pr-8 cursor-pointer font-medium">
                        <option value="newest">Más Recientes</option>
                        <option value="popular">Más Populares</option>
                        <option value="price_asc">Precio: Bajo</option>
                        <option value="price_desc">Precio: Alto</option>
                    </select>
                </div>
            </div>

            @if($courses->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 relative min-h-[300px]">
                    
                    <div wire:loading.flex class="absolute inset-0 bg-white/80 z-20 items-center justify-center backdrop-blur-sm rounded-xl">
                        <div class="flex flex-col items-center">
                            <div class="animate-spin rounded-full h-10 w-10 border-4 border-red-500 border-t-transparent mb-3"></div>
                            <span class="text-xs font-bold text-red-500 uppercase tracking-widest">Cargando...</span>
                        </div>
                    </div>

                    @foreach($courses as $course)
                        <article class="bg-white rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-100 overflow-hidden flex flex-col h-full group">
                            
                            <a href="{{ route('courses.show', $course) }}" class="relative h-44 block overflow-hidden bg-gray-200">
                                @if($course->image_path)
                                    <img src="{{ asset($course->image_path) }}" 
                                         alt="{{ $course->title }}" 
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-slate-100 text-slate-300">
                                        <i class="fas fa-image text-3xl"></i>
                                    </div>
                                @endif

                                <div class="absolute top-3 left-3">
                                    <span class="bg-white/90 backdrop-blur text-slate-800 text-[10px] font-bold px-2 py-1 rounded shadow-sm border border-gray-100">
                                        {{ $course->category->name ?? 'General' }}
                                    </span>
                                </div>
                            </a>

                            <div class="p-5 flex flex-col flex-1">
                                <div class="flex items-center gap-2 mb-3">
                                    <img src="{{ $course->teacher->profile_photo_url }}" class="w-6 h-6 rounded-full border border-gray-100 shadow-sm">
                                    <span class="text-[11px] font-bold text-slate-500 uppercase truncate">{{ $course->teacher->name }}</span>
                                </div>

                                <h3 class="font-bold text-slate-900 text-base leading-snug mb-2 line-clamp-2 group-hover:text-red-600 transition-colors">
                                    <a href="{{ route('courses.show', $course) }}">
                                        {{ $course->title }}
                                    </a>
                                </h3>

                                <div class="flex items-center gap-1 mb-4">
                                    <div class="flex text-yellow-400 text-xs">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    </div>
                                    <span class="text-xs text-slate-400 font-medium ml-1">(5.0)</span>
                                </div>

                                <div class="mt-auto pt-4 border-t border-gray-50 flex items-center justify-between">
                                    <div>
                                        @if($course->price == 0)
                                            <span class="text-emerald-600 font-black text-lg">GRATIS</span>
                                        @else
                                            <div class="flex flex-col leading-none">
                                                @if($course->compare_price)
                                                    <span class="text-[10px] text-slate-400 line-through mb-0.5">S/. {{ number_format($course->compare_price, 2) }}</span>
                                                @endif
                                                <span class="text-slate-900 font-black text-lg">S/. {{ number_format($course->price, 2) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <a href="{{ route('courses.show', $course) }}" class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition shadow-sm">
                                        <i class="fas fa-chevron-right text-xs"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $courses->links() }} 
                </div>
            @else
                <div class="text-center py-20 bg-white rounded-2xl border border-dashed border-slate-200">
                    <div class="bg-red-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 text-red-500 text-3xl">
                        <i class="fas fa-search-minus"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800">Sin resultados</h3>
                    <p class="text-slate-500 mb-6">No encontramos cursos con esos filtros.</p>
                    <button wire:click="resetFilters" class="text-white bg-slate-800 px-6 py-2 rounded-full text-sm font-bold hover:bg-slate-700 transition">
                        Limpiar filtros
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>