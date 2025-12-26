<x-web-layout>
    
    <div class="bg-gray-900 text-white pt-32 pb-16 relative overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center opacity-30" style="background-image: url('{{ $course->image_path }}'); filter: blur(8px);"></div>
        
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/60 to-gray-900/30"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="md:w-2/3">
                <div class="flex items-center gap-2 mb-4">
                    <span class="bg-indigo-600 text-white text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">Curso Online</span>
                    @if($course->price == 0)
                        <span class="bg-green-500 text-white text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">Gratis</span>
                    @endif
                </div>

                <h1 class="text-4xl md:text-5xl font-heading font-extrabold mb-4 leading-tight shadow-sm">{{ $course->title }}</h1>
                <p class="text-gray-300 text-lg mb-6 leading-relaxed">{{ Str::limit($course->description, 160) }}</p>
                
                <div class="flex flex-wrap items-center gap-6 text-sm font-medium">
                    <div class="flex items-center gap-2 bg-white/10 px-3 py-1.5 rounded-full backdrop-blur-sm">
                        <img src="{{ $course->teacher->profile_photo_url }}" class="w-6 h-6 rounded-full border border-white/50">
                        <span class="text-gray-200">Por <span class="text-white">{{ $course->teacher->name }}</span></span>
                    </div>

                    <div class="flex items-center text-yellow-400 gap-1">
                        @for($i=1; $i<=5; $i++) 
                            <i class="fas fa-star {{ $course->rating >= $i ? '' : 'text-gray-600' }}"></i> 
                        @endfor
                        <span class="text-white ml-1 font-bold">{{ $course->rating }}</span>
                        <span class="text-gray-400 font-normal">({{ $course->reviews_count }} reseñas)</span>
                    </div>

                    <div class="flex items-center text-gray-300 gap-2">
                        <i class="fas fa-globe text-indigo-400"></i> Español
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-16 bg-gray-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                
                <div class="lg:col-span-2">
                    <div class="mb-10 rounded-2xl overflow-hidden shadow-2xl border-4 border-white">
                        <img src="{{ $course->image_path }}" class="w-full h-auto object-cover transform hover:scale-105 transition duration-700">
                    </div>

                    <div x-data="{ tab: 'overview' }" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="flex border-b border-gray-100">
                            <button @click="tab = 'overview'" :class="tab === 'overview' ? 'text-indigo-600 border-b-2 border-indigo-600 bg-indigo-50/50' : 'text-gray-500 hover:text-gray-700'" class="flex-1 py-4 font-bold text-sm uppercase tracking-wide transition-all">Descripción</button>
                            <button @click="tab = 'curriculum'" :class="tab === 'curriculum' ? 'text-indigo-600 border-b-2 border-indigo-600 bg-indigo-50/50' : 'text-gray-500 hover:text-gray-700'" class="flex-1 py-4 font-bold text-sm uppercase tracking-wide transition-all">Temario</button>
                            <button @click="tab = 'reviews'" :class="tab === 'reviews' ? 'text-indigo-600 border-b-2 border-indigo-600 bg-indigo-50/50' : 'text-gray-500 hover:text-gray-700'" class="flex-1 py-4 font-bold text-sm uppercase tracking-wide transition-all">Reseñas</button>
                        </div>

                        <div class="p-8">
                            <div x-show="tab === 'overview'" x-transition.opacity class="prose max-w-none text-gray-600">
                                <h3 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                                    <i class="fas fa-info-circle text-indigo-500"></i> Sobre este curso
                                </h3>
                                <p class="leading-relaxed">{{ $course->description }}</p>
                            </div>

                            <div x-show="tab === 'curriculum'" x-transition.opacity class="space-y-4">
                                <div class="flex justify-between items-center mb-6">
                                    <h3 class="text-xl font-bold text-gray-900">Contenido del curso</h3>
                                    <span class="text-xs font-bold text-gray-500 bg-gray-100 px-2 py-1 rounded">{{ $course->sections->count() }} Secciones</span>
                                </div>

                                @foreach($course->sections as $section)
                                    <div x-data="{ open: false }" class="border border-gray-200 rounded-xl overflow-hidden">
                                        <button @click="open = !open" class="w-full flex justify-between items-center p-4 bg-gray-50 hover:bg-white transition cursor-pointer">
                                            <span class="font-bold text-gray-800 flex items-center gap-3">
                                                <i :class="open ? 'fa-angle-down' : 'fa-angle-right'" class="text-gray-400 transition-transform"></i>
                                                {{ $section->title }}
                                            </span>
                                            <span class="text-xs text-gray-500 font-medium bg-white px-2 py-1 rounded border border-gray-200">{{ $section->lessons->count() }} clases</span>
                                        </button>
                                        <div x-show="open" class="bg-white border-t border-gray-100 divide-y divide-gray-50">
                                            @foreach($section->lessons as $lesson)
                                                <div class="flex items-center justify-between p-3 pl-10 hover:bg-indigo-50/30 transition">
                                                    <div class="flex items-center gap-3">
                                                        <div class="w-6 h-6 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-xs">
                                                            <i class="fas fa-play"></i>
                                                        </div>
                                                        <span class="text-sm text-gray-700 font-medium">{{ $lesson->title }}</span>
                                                    </div>
                                                    <div class="flex items-center gap-3">
                                                        @if($lesson->is_free)
                                                            <span class="text-[10px] font-bold text-green-600 border border-green-200 px-2 py-0.5 rounded bg-green-50">GRATIS</span>
                                                        @endif
                                                        <span class="text-xs text-gray-400">{{ $lesson->duration_minutes }} min</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div x-show="tab === 'reviews'" x-transition.opacity>
    
                                <div class="flex items-center gap-6 bg-gray-50 p-6 rounded-2xl border border-gray-100 mb-8">
                                    <div class="text-center min-w-[100px]">
                                        <span class="block text-5xl font-extrabold text-slate-800">{{ number_format($course->rating, 1) }}</span>
                                        <div class="text-yellow-400 text-xs mt-2 mb-1">
                                            @for($i=1; $i<=5; $i++) 
                                                <i class="fas fa-star {{ $course->rating >= $i ? '' : 'text-gray-300' }}"></i> 
                                            @endfor
                                        </div>
                                        <span class="text-xs text-gray-500 font-medium">Promedio General</span>
                                    </div>
                                    
                                    <div class="h-16 w-px bg-gray-200 hidden sm:block"></div>
                                    
                                    <div class="flex-1 text-sm text-gray-600">
                                        <p>Basado en <strong>{{ $course->reviews_count }}</strong> reseñas de estudiantes verificados.</p>
                                    </div>
                                </div>

                                @livewire('web.course-reviews', ['course' => $course])

                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="sticky top-28 space-y-6">
                        
                        <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-100 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-20 h-20 bg-indigo-500 blur-3xl opacity-10 rounded-full pointer-events-none"></div>
                            
                            <div class="flex items-end gap-2 mb-6">
                                @if($course->price == 0)
                                    <span class="text-4xl font-extrabold text-gray-900">Gratis</span>
                                @else
                                    <span class="text-4xl font-extrabold text-gray-900">S/.{{ number_format($course->price, 2) }}</span>
                                    @if($course->compare_price)
                                        <span class="text-lg text-gray-400 line-through mb-1.5">S/.{{ number_format($course->compare_price, 2) }}</span>
                                    @endif
                                @endif
                            </div>

                            @if($isEnrolled)
                                @if($enrollmentStatus === 'active')
                                    <a href="{{ route('student.course.learn', $course) }}" class="flex items-center justify-center w-full py-4 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-xl transition shadow-lg shadow-emerald-200 group">
                                        <span class="mr-2">Ir al Aula Virtual</span>
                                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                                    </a>
                                @else
                                    <div class="bg-amber-50 border border-amber-200 text-amber-800 p-4 rounded-xl flex items-start gap-3">
                                        <i class="fas fa-clock mt-1 text-amber-500"></i>
                                        <div>
                                            <span class="font-bold block text-sm">Validación en proceso</span>
                                            <span class="text-xs opacity-80">Estamos verificando tu pago.</span>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <form action="{{ route('enrollments.store', $course) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition shadow-lg shadow-indigo-200 transform hover:-translate-y-0.5">
                                        {{ $course->price == 0 ? '¡Inscríbete Gratis Ahora!' : 'Comprar Curso' }}
                                    </button>
                                </form>
                                <p class="text-center text-xs text-gray-400 mt-3 flex items-center justify-center gap-1">
                                    <i class="fas fa-lock"></i> Pago 100% Seguro
                                </p>
                            @endif

                            <div class="mt-8 space-y-4">
                                <h4 class="font-bold text-gray-900 text-sm">Este curso incluye:</h4>
                                <ul class="space-y-3 text-sm text-gray-600">
                                    <li class="flex items-center gap-3"><i class="fas fa-video text-indigo-500 w-5 text-center"></i> {{ $course->lessons->count() }} Lecciones en video</li>
                                    <li class="flex items-center gap-3"><i class="fas fa-clock text-indigo-500 w-5 text-center"></i> {{ $course->lessons->sum('duration_minutes') }} min de contenido</li>
                                    <li class="flex items-center gap-3"><i class="fas fa-mobile-alt text-indigo-500 w-5 text-center"></i> Acceso en móviles</li>
                                    <li class="flex items-center gap-3"><i class="fas fa-infinity text-indigo-500 w-5 text-center"></i> Acceso de por vida</li>
                                    
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-web-layout>