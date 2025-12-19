<x-web-layout>
    
    <div class="mb-8 mt-4 flex flex-wrap gap-3 items-center justify-center md:justify-start">
        
        <a href="{{ route('home') }}" 
           class="{{ !request('category') ? 'bg-red-600 text-white shadow-md ring-2 ring-red-100' : 'bg-white text-slate-600 border border-gray-200 hover:border-red-400' }} px-5 py-2.5 rounded-full text-sm font-bold transition-all flex items-center gap-2">
            Todos
        </a>

        @foreach($globalCategories as $category)
            <a href="{{ route('home', ['category' => $category->id]) }}" 
               class="{{ request('category') == $category->id ? 'bg-orange-500 text-white shadow-md ring-2 ring-orange-100 transform scale-105' : 'bg-white text-slate-600 border border-gray-200 hover:border-orange-400 hover:text-orange-500' }} px-5 py-2.5 rounded-full text-sm font-bold transition-all flex items-center gap-2">
                
                {{ $category->name }}
                
                @if(request('category') == $category->id)
                    <i class="fas fa-check-circle text-white ml-1"></i>
                @endif
            </a>
        @endforeach
    </div>

    @if(!request()->has('category'))
        <div class="mb-10 w-full rounded-3xl overflow-hidden shadow-xl relative h-[220px] md:h-[320px] group">
            <div class="swiper mySwiper w-full h-full">
                <div class="swiper-wrapper">
                    @foreach($sliders as $slider)
                        <div class="swiper-slide w-full h-full relative">
                            <img src="{{ $slider->image_path }}" class="w-full h-full object-cover" alt="{{ $slider->title }}">
                            <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/20 to-transparent flex items-center px-8 md:px-16">
                                <div class="text-white max-w-xl translate-y-4 opacity-0 transition-all duration-700 group-hover:translate-y-0 group-hover:opacity-100">
                                    <span class="bg-orange-500 text-white text-[10px] font-bold px-2 py-1 rounded uppercase mb-2 inline-block">Novedad</span>
                                    <h2 class="text-2xl md:text-5xl font-extrabold uppercase leading-tight mb-4 drop-shadow-lg">{{ $slider->title }}</h2>
                                    @if($slider->link_url)
                                        <a href="{{ $slider->link_url }}" class="bg-white text-slate-900 hover:bg-orange-500 hover:text-white font-bold py-2.5 px-6 rounded-full transition shadow-lg inline-flex items-center gap-2 text-sm">
                                            VER MÁS <i class="fas fa-arrow-right"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    @else
        <div class="mb-6 border-l-4 border-orange-500 pl-4 animate-fade-in-down">
            <h2 class="text-2xl font-extrabold text-slate-800">
                Cursos de <span class="text-orange-500">
                    {{ $globalCategories->find(request('category'))->name ?? 'Selección' }}
                </span>
            </h2>
            <p class="text-slate-500 text-sm">Explora nuestro catálogo especializado.</p>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($courses as $course)
            <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-100 overflow-hidden group flex flex-col h-full">
                
                <a href="{{ route('courses.show', $course) }}" class="relative h-44 overflow-hidden block bg-gray-100">
                    <img src="{{ $course->image_path ?? asset('images/no-image.jpg') }}" alt="{{ $course->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    
                    <div class="absolute top-3 left-3">
                        <span class="bg-orange-500 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase shadow-sm">
                            {{ $course->category->name ?? 'General' }}
                        </span>
                    </div>
                </a>

                <div class="p-5 flex flex-col flex-1">
                    <h3 class="font-bold text-slate-800 text-sm leading-snug mb-3 min-h-[40px] line-clamp-2 hover:text-orange-600 transition-colors">
                        <a href="{{ route('courses.show', $course) }}">
                            {{ $course->title }}
                        </a>
                    </h3>
                    
                    <div class="flex items-center gap-3 mb-4 text-xs text-slate-500 font-medium">
                        <div class="flex items-center gap-1 bg-slate-50 px-2 py-1 rounded">
                            <i class="fas fa-layer-group text-orange-400"></i>
                            <span>{{ $course->lessons_count ?? 0 }} Módulos</span>
                        </div>
                    </div>

                    <div class="mt-auto flex items-center justify-between border-t border-gray-100 pt-3">
                        <div class="flex flex-col">
                            @if($course->price == 0)
                                <span class="text-lg font-black text-red-600 uppercase tracking-tight flex items-center gap-1">
                                    ¡GRATIS! <i class="fas fa-gift"></i>
                                </span>
                            @else
                                @if($course->discount_price)
                                    <span class="text-[10px] text-slate-400 line-through">S/. {{ number_format($course->price, 2) }}</span>
                                    <span class="text-lg font-extrabold text-slate-900">S/. {{ number_format($course->discount_price, 2) }}</span>
                                @else
                                    <span class="text-lg font-extrabold text-slate-900">S/. {{ number_format($course->price, 2) }}</span>
                                @endif
                            @endif
                        </div>
                        
                        <a href="{{ route('courses.show', $course) }}" class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-red-500 hover:text-white transition">
                            <i class="fas fa-chevron-right text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center">
                <div class="bg-slate-50 rounded-3xl p-8 max-w-lg mx-auto border border-dashed border-slate-300">
                    <div class="w-16 h-16 bg-slate-200 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-400 text-2xl">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-700 mb-2">No se encontraron cursos</h3>
                    <p class="text-slate-500 text-sm mb-6">No hay cursos disponibles en esta categoría por el momento.</p>
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-white bg-red-600 hover:bg-red-700 font-bold py-2 px-6 rounded-full transition text-sm">
                        Ver todos los cursos
                    </a>
                </div>
            </div>
        @endforelse
    </div>
    
    <div class="mt-8">
        {{ $courses->links() }}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if(document.querySelector(".mySwiper")) {
                new Swiper(".mySwiper", {
                    loop: true,
                    autoplay: { delay: 4000, disableOnInteraction: false },
                    pagination: { el: ".swiper-pagination", clickable: true },
                    effect: 'fade',
                    fadeEffect: { crossFade: true },
                });
            }
        });
    </script>
</x-web-layout>