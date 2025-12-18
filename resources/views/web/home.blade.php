<x-web-layout>
    
    <div class="relative h-[650px] md:h-[800px] overflow-hidden"> 
        <div class="swiper mySwiper w-full h-full">
            <div class="swiper-wrapper">
                @foreach($sliders as $slider)
                    <div class="swiper-slide relative">
                        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-[10s] scale-100 hover:scale-110 ease-linear" 
                             style="background-image: url('{{ $slider->image_path }}');">
                        </div>
                        
                        <div class="absolute inset-0 bg-slate-900/30"></div>
                        
                        <div class="absolute inset-0 flex items-center">
                            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full pt-20">
                                <div class="max-w-3xl" data-aos="fade-up">
                                    
                                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-indigo-300 text-xs font-bold uppercase tracking-widest mb-6">
                                        <span class="w-2 h-2 rounded-full bg-white"></span>
                                        {{ $slider->subtitle ?? 'Plataforma E-Learning' }}
                                    </div>

                                    <h1 class="text-5xl md:text-7xl font-heading font-extrabold text-white mb-6 leading-tight drop-shadow-xl">
                                        {{ $slider->title }}
                                    </h1>
                                    
                                    @if($slider->link_url)
                                        <div class="flex flex-col sm:flex-row gap-4 mt-8">
                                            <a href="{{ $slider->link_url }}" class="px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-full shadow-lg shadow-indigo-600/40 transform hover:scale-105 transition-all text-center">
                                                Comenzar Ahora
                                            </a>
                                            <a href="#courses" class="px-8 py-4 bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/30 text-white font-bold rounded-full transform hover:scale-105 transition-all text-center">
                                                Ver Cursos
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination !bottom-12 !left-8 !w-auto"></div>
        </div>
    </div>

    <div class="relative -mt-24 z-30 max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
                $features = [
                    [
                        'icon' => 'fa-laptop-code', 
                        'title' => 'Aprendizaje Flexible', 
                        'desc' => 'Accede a tus clases desde cualquier dispositivo, a tu ritmo y sin horarios rígidos.', 
                        'gradient' => 'from-blue-500 to-cyan-400',
                        'shadow' => 'shadow-blue-500/40',
                        'text_hover' => 'text-blue-600'
                    ],
                    [
                        'icon' => 'fa-user-astronaut', 
                        'title' => 'Docentes Expertos', 
                        'desc' => 'Aprende directamente de líderes de la industria que ya lograron lo que tú buscas.', 
                        'gradient' => 'from-violet-600 to-fuchsia-500',
                        'shadow' => 'shadow-violet-500/40',
                        'text_hover' => 'text-violet-600'
                    ],
                    [
                        'icon' => 'fa-certificate', 
                        'title' => 'Materiales Exclusivos', 
                        'desc' => 'Contenido exclusivo para ti que contribuye a tu formación.', 
                        'gradient' => 'from-emerald-500 to-teal-400',
                        'shadow' => 'shadow-emerald-500/40',
                        'text_hover' => 'text-emerald-600'
                    ]
                ];
            @endphp

            @foreach($features as $index => $f)
                <div class="group relative bg-white rounded-[2rem] p-8 shadow-xl hover:shadow-2xl transition-all duration-300 ease-out hover:-translate-y-3 overflow-hidden" 
                     data-aos="fade-up" 
                     data-aos-delay="{{ $index * 150 }}">
                    
                    <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 bg-gradient-to-br {{ $f['gradient'] }} opacity-10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500"></div>
                    
                    <div class="relative z-10">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br {{ $f['gradient'] }} flex items-center justify-center text-white text-2xl shadow-lg {{ $f['shadow'] }} mb-6 transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <i class="fas {{ $f['icon'] }}"></i>
                        </div>

                        <h3 class="text-xl font-heading font-extrabold text-slate-800 mb-3 group-hover:{{ $f['text_hover'] }} transition-colors">
                            {{ $f['title'] }}
                        </h3>
                        <p class="text-slate-500 text-sm leading-relaxed mb-6">
                            {{ $f['desc'] }}
                        </p>

                        <div class="flex items-center font-bold text-sm {{ $f['text_hover'] }} opacity-0 -translate-x-4 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300">
                            <span>Saber más</span>
                            <i class="fas fa-arrow-right ml-2 animate-pulse"></i>
                        </div>
                    </div>

                    <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r {{ $f['gradient'] }} transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
                </div>
            @endforeach
        </div>
    </div>

    <section id="courses" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12">
                <div data-aos="fade-right">
                    <span class="text-indigo-600 font-bold uppercase tracking-wider text-sm">Descubre tu potencial</span>
                    <h2 class="text-4xl font-extrabold text-gray-900 mt-2">Cursos Más Populares <span class="text-indigo-600">.</span></h2>
                </div>
                <a href="{{ route('courses.index') }}" class="hidden md:inline-flex items-center font-bold text-gray-600 hover:text-indigo-600 transition" data-aos="fade-left">
                    Ver catálogo completo <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($courses as $index => $course)
                    <div data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <x-course-card :course="$course" />
                    </div>
                @endforeach
            </div>
            
            <div class="mt-12 text-center md:hidden">
                <a href="{{ route('courses.index') }}" class="btn-primary w-full">Ver todos los cursos</a>
            </div>
        </div>
    </section>

    <section class="py-20 relative bg-gray-900 overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-indigo-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-purple-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center text-white">
                <x-stat-counter icon="fa-users" :target="$stats['students']" label="Estudiantes Activos" />
                <x-stat-counter icon="fa-book-open" :target="$stats['courses']" label="Cursos Disponibles" />
                <x-stat-counter icon="fa-video" :target="$stats['lessons']" label="Lecciones Totales" />
                <x-stat-counter icon="fa-clock" :target="$stats['hours']" label="Horas de Contenido" suffix="+" />
            </div>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-5xl mx-auto px-4">
            <div class="relative bg-gradient-to-r from-indigo-600 to-violet-600 rounded-3xl p-12 md:p-20 text-center text-white shadow-2xl overflow-hidden" data-aos="zoom-in">
                <div class="absolute top-0 left-0 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-white/10 rounded-full blur-2xl"></div>
                <div class="absolute bottom-0 right-0 transform translate-x-1/2 translate-y-1/2 w-64 h-64 bg-white/10 rounded-full blur-2xl"></div>

                <h2 class="relative z-10 text-3xl md:text-5xl font-extrabold mb-6">¿Listo para transformar tu futuro?</h2>
                <p class="relative z-10 text-indigo-100 text-lg md:text-xl mb-10 max-w-2xl mx-auto">Únete a nuestra comunidad de aprendizaje hoy mismo y accede a todos los cursos con una sola matrícula.</p>
                
                <a href="{{ route('register') }}" class="relative z-10 inline-flex items-center bg-white text-indigo-700 font-bold py-4 px-10 rounded-full shadow-lg hover:shadow-white/20 hover:scale-105 transition transform">
                    Crear Cuenta Gratis <i class="fas fa-rocket ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Swiper(".mySwiper", {
                effect: "fade",
                autoplay: { delay: 6000, disableOnInteraction: false },
                speed: 1000,
                loop: true,
                pagination: { el: ".swiper-pagination", clickable: true, dynamicBullets: true },
            });
        });
    </script>

</x-web-layout>