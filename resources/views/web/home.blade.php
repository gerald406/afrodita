<x-web-layout>
    <div class="mb-6 flex overflow-x-auto pb-2 gap-2 hide-scrollbar">
    
    <a href="{{ route('home') }}" class="whitespace-nowrap px-4 py-2 rounded-full text-sm font-bold {{ !request('category') ? 'bg-slate-800 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }} transition-colors">
        Todos
    </a>

    @foreach($globalCategories as $cat)
        <a href="{{ route('home', ['category' => $cat->id]) }}" 
           class="whitespace-nowrap px-4 py-2 rounded-full text-sm font-bold transition-colors
                  {{ request('category') == $cat->id 
                      ? 'bg-red-600 text-white shadow-lg shadow-red-200' 
                      : 'bg-white text-slate-600 border border-slate-200 hover:border-red-300 hover:text-red-500' }}">
            {{ $cat->name }}
        </a>
    @endforeach

</div>

    @if(!request()->has('category'))
        <div class="mb-10 w-full rounded-3xl overflow-hidden shadow-2xl shadow-slate-200 relative aspect-[16/9] md:aspect-[21/9] group bg-white">
            <div class="swiper mySwiper w-full h-full">
                <div class="swiper-wrapper">
                    @forelse($sliders as $slider)
                        <div class="swiper-slide w-full h-full relative">
                            
                            {{-- 1. IMAGEN: Sin opacidad, con efecto zoom suave al hover --}}
                            <img src="{{ asset($slider->image_path) }}" 
                                 class="w-full h-full object-cover transition-transform duration-[2000ms] group-hover:scale-105" 
                                 alt="{{ $slider->title }}">
                            
                            {{-- 2. GRADIENTE SUTIL: Solo para que el texto blanco se lea, sin oscurecer toda la foto --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent md:bg-gradient-to-r md:from-black/60 md:via-transparent md:to-transparent flex items-end md:items-center px-6 py-10 md:px-16">
                                
                                {{-- 3. TEXTO ANIMADO: Entra desde abajo --}}
                                <div class="max-w-2xl animate-fade-in-up">
                                    <span class="inline-block bg-red-600 text-white text-[10px] md:text-xs font-black px-3 py-1 rounded-full uppercase tracking-widest mb-4 shadow-lg shadow-red-600/30">
                                        Destacado
                                    </span>
                                    <h2 class="text-3xl md:text-5xl lg:text-6xl font-black text-white leading-tight mb-4 md:mb-6 drop-shadow-lg">
                                        {{ $slider->title }}
                                    </h2>
                                    <p class="text-white text-sm md:text-lg mb-8 line-clamp-2 md:line-clamp-none drop-shadow-md font-medium">
                                        {{ $slider->subtitle ?? 'Aprende con los mejores expertos y certifica tus conocimientos hoy mismo.' }}
                                    </p>
                                    @if($slider->link_url)
                                        <a href="{{ $slider->link_url }}" class="bg-white text-slate-900 hover:bg-red-600 hover:text-white font-bold py-3 md:py-4 px-8 rounded-full transition-all shadow-xl hover:shadow-2xl inline-flex items-center gap-2 text-sm md:text-base transform hover:-translate-y-1">
                                            <span>Explorar Curso</span>
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        {{-- Slide por defecto si no hay datos --}}
                        <div class="swiper-slide w-full h-full relative bg-slate-100 flex items-center justify-center">
                            <h2 class="text-slate-400 text-2xl font-bold">Bienvenido a LMS PRO</h2>
                        </div>
                    @endforelse
                </div>
                {{-- Paginación --}}
                <div class="swiper-pagination !bottom-6 !left-auto !right-6 md:!right-16 !w-auto"></div>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-12">
            <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-500">
                    <i class="fas fa-certificate text-lg"></i>
                </div>
                <div>
                    <h5 class="font-bold text-slate-800 text-xs md:text-sm">Recursos</h5>
                    <p class="text-[10px] text-slate-400">Oficial y válida</p>
                </div>
            </div>
            <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-green-500">
                    <i class="fas fa-infinity text-lg"></i>
                </div>
                <div>
                    <h5 class="font-bold text-slate-800 text-xs md:text-sm">Acceso Vitalicio</h5>
                    <p class="text-[10px] text-slate-400">Estudia a tu ritmo</p>
                </div>
            </div>
            <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-purple-50 flex items-center justify-center text-purple-500">
                    <i class="fas fa-users text-lg"></i>
                </div>
                <div>
                    <h5 class="font-bold text-slate-800 text-xs md:text-sm">Comunidad</h5>
                    <p class="text-[10px] text-slate-400">Aprende con pares</p>
                </div>
            </div>
            <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-orange-50 flex items-center justify-center text-orange-500">
                    <i class="fas fa-chalkboard-teacher text-lg"></i>
                </div>
                <div>
                    <h5 class="font-bold text-slate-800 text-xs md:text-sm">Expertos</h5>
                    <p class="text-[10px] text-slate-400">Docentes calificados</p>
                </div>
            </div>
        </div>
    @else
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-black text-slate-800 tracking-tight">
                    {{ $globalCategories->find(request('category'))->name }}
                </h2>
                <p class="text-slate-500 mt-1">Explora nuestros cursos especializados en esta área.</p>
            </div>
            <a href="{{ route('home') }}" class="hidden md:flex items-center gap-2 text-sm font-bold text-red-600 hover:text-red-700 bg-red-50 px-4 py-2 rounded-lg transition">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    @endif

    <div class="flex items-center justify-between mb-6">
        <h3 class="font-bold text-xl text-slate-800 flex items-center gap-2">
            <i class="fas fa-fire text-orange-500"></i> 
            {{ request('category') ? 'Cursos Disponibles' : 'Nuevos Lanzamientos' }}
        </h3>
        <div class="hidden md:flex items-center gap-2 text-sm text-slate-500">
            <span class="font-medium">Ordenar por:</span>
            <select class="bg-transparent border-none text-sm font-bold text-slate-700 focus:ring-0 cursor-pointer">
                <option>Más Recientes</option>
                <option>Más Populares</option>
            </select>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-6 gap-y-8">
        @forelse($courses as $course)
            <article class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden group hover:shadow-xl hover:shadow-slate-200/50 hover:-translate-y-1 transition-all duration-300 flex flex-col h-full relative">
                
                <div class="absolute top-3 left-3 z-10 flex gap-2">
                    <span class="bg-white/90 backdrop-blur text-slate-800 text-[10px] font-bold px-2 py-1 rounded shadow-sm border border-gray-100 flex items-center gap-1">
                        <i class="fas fa-tag text-red-500"></i> {{ $course->category->name ?? 'Sin Categoría' }}
                    </span>
                    @if($loop->iteration <= 3 && !request('category'))
                        <span class="bg-red-500 text-white text-[10px] font-bold px-2 py-1 rounded shadow-sm animate-pulse">
                            NUEVO
                        </span>
                    @endif
                </div>

                <a href="{{ route('courses.show', $course) }}" class="block relative h-48 overflow-hidden bg-gray-200">
                    <img src="{{ $course->image_path }}" alt="{{ $course->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition flex items-center justify-center opacity-0 group-hover:opacity-100">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-red-600 shadow-lg transform scale-0 group-hover:scale-100 transition-transform duration-300">
                            <i class="fas fa-play pl-1"></i>
                        </div>
                    </div>
                </a>

                <div class="p-5 flex flex-col flex-1">
                    
                    <div class="flex items-center gap-2 text-[10px] font-bold text-slate-400 mb-2 uppercase tracking-wide">
                        <span><i class="fas fa-video mr-1"></i>Curso Online</span>
                        <span>•</span>
                        <span>{{ $course->teacher->name }}</span>
                    </div>

                    <h3 class="font-bold text-slate-800 text-base leading-snug mb-2 line-clamp-2 group-hover:text-red-600 transition-colors">
                        <a href="{{ route('courses.show', $course) }}">
                            {{ $course->title }}
                        </a>
                    </h3>

                    <div class="flex items-center gap-1 text-yellow-400 text-xs mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <span class="text-slate-400 ml-1 font-medium">(4.8)</span>
                    </div>

                    <div class="mt-auto pt-4 border-t border-gray-50 flex items-center justify-between">
                        <div>
                            @if($course->price == 0)
                                <span class="text-emerald-600 font-black text-lg">GRATIS</span>
                            @else
                                <div class="flex flex-col">
                                    <span class="text-slate-400 text-xs line-through">S/. {{ number_format($course->price * 1.5, 2) }}</span>
                                    <span class="text-slate-900 font-black text-lg">S/. {{ number_format($course->price, 2) }}</span>
                                </div>
                            @endif
                        </div>
                        <a href="{{ route('courses.show', $course) }}" class="text-red-600 hover:bg-red-50 p-2 rounded-lg transition">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full py-12">
                <div class="bg-white rounded-3xl p-8 border border-dashed border-gray-300 text-center">
                    <div class="bg-red-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 text-red-500 text-2xl">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 class="font-bold text-lg text-slate-800">No encontramos cursos</h3>
                    <p class="text-slate-500 text-sm mb-6">Intenta seleccionar otra categoría o ver todo el catálogo.</p>
                    <a href="{{ route('home') }}" class="inline-block bg-slate-800 text-white font-bold py-2 px-6 rounded-full text-sm hover:bg-slate-700 transition">
                        Ver todo
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-12 mb-8">
        {{ $courses->links() }}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if(document.querySelector(".mySwiper")) {
                new Swiper(".mySwiper", {
                    loop: true,
                    effect: 'fade',
                    fadeEffect: { crossFade: true },
                    speed: 1000,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                        dynamicBullets: true,
                    },
                });
            }
        });
    </script>
</x-web-layout>