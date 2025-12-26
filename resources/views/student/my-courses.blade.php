<x-web-layout>
    
    <div class="bg-slate-900 pt-32 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-3xl font-heading font-extrabold text-white mb-2">Mis Cursos</h1>
                    <p class="text-slate-400">Gestiona tu aprendizaje y continúa donde lo dejaste.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm mb-6" role="alert">
                    <p class="font-bold">¡Éxito!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if($enrollments->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($enrollments as $enrollment)
                        @php
                            $course = $enrollment->course;
                            // [CORRECCIÓN] Usamos el método del usuario para asegurar el cálculo correcto
                            $progress = Auth::user()->courseProgress($course);
                        @endphp

                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col h-full group">
                            
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ $course->image_path }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors"></div>
                                
                                <div class="absolute top-3 right-3">
                                    @if($progress == 100)
                                        <span class="bg-green-500 text-white text-[10px] font-bold px-2 py-1 rounded-full shadow-lg">COMPLETADO</span>
                                    @elseif($progress > 0)
                                        <span class="bg-amber-500 text-white text-[10px] font-bold px-2 py-1 rounded-full shadow-lg">EN PROGRESO</span>
                                    @else
                                        <span class="bg-indigo-500 text-white text-[10px] font-bold px-2 py-1 rounded-full shadow-lg">NUEVO</span>
                                    @endif
                                </div>
                            </div>

                            <div class="p-6 flex-1 flex flex-col">
                                <div class="mb-4">
                                    <h3 class="text-lg font-bold text-slate-800 leading-snug mb-2 line-clamp-2 group-hover:text-indigo-600 transition-colors">
                                        {{ $course->title }}
                                    </h3>
                                    <div class="flex items-center gap-2 text-xs text-slate-500">
                                        <img src="{{ $course->teacher->profile_photo_url }}" class="w-5 h-5 rounded-full border border-slate-200">
                                        <span>{{ $course->teacher->name }}</span>
                                    </div>
                                </div>

                                <div class="mt-auto">
                                    <div class="flex justify-between items-end mb-2">
                                        <span class="text-xs font-bold text-slate-700">Avance</span>
                                        <span class="text-xs font-bold {{ $progress == 100 ? 'text-green-600' : 'text-indigo-600' }}">{{ $progress }}%</span>
                                    </div>
                                    <div class="w-full bg-slate-100 rounded-full h-2 mb-6 overflow-hidden">
                                        <div class="h-full rounded-full transition-all duration-1000 ease-out {{ $progress == 100 ? 'bg-green-500' : 'bg-indigo-500' }}" 
                                            style="width: {{ $progress }}%"></div>
                                    </div>

                                    @if($progress == 0)
                                        <a href="{{ route('student.course.learn', $course) }}" class="block w-full py-3 text-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition shadow-lg shadow-indigo-200">
                                            <i class="fas fa-play mr-2"></i> Iniciar Curso
                                        </a>
                                    @elseif($progress < 100)
                                        <a href="{{ route('student.course.learn', $course) }}" class="block w-full py-3 text-center bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl transition shadow-lg shadow-amber-200">
                                            <i class="fas fa-forward mr-2"></i> Continuar Curso
                                        </a>
                                    @else
                                        <a href="{{ route('student.course.learn', $course) }}" class="block w-full py-3 text-center bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl transition shadow-lg shadow-green-200">
                                            <i class="fas fa-redo mr-2"></i> Repasar Curso
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $enrollments->links() }}
                </div>
            @else
                <div class="text-center py-24 bg-white rounded-3xl border border-dashed border-slate-200">
                    <div class="bg-indigo-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 text-indigo-500 text-4xl animate-bounce">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800 mb-2">Tu aprendizaje comienza aquí</h3>
                    <p class="text-slate-500 mb-8 max-w-md mx-auto">Aún no tienes cursos activos. Explora nuestro catálogo y adquiere nuevas habilidades hoy.</p>
                    <a href="{{ route('courses.index') }}" class="inline-flex items-center bg-indigo-600 text-white px-8 py-4 rounded-full font-bold shadow-xl hover:shadow-2xl hover:-translate-y-1 transition transform">
                        Explorar Catálogo <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-web-layout>