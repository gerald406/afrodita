<x-web-layout>
    
    <div class="relative bg-slate-900 pt-32 pb-20 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-900 via-slate-900 to-black"></div>
        <div class="absolute top-0 left-1/4 -mt-20 w-96 h-96 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob"></div>
        <div class="absolute bottom-0 right-1/4 -mb-20 w-96 h-96 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-2000"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-heading font-extrabold text-white mb-4 tracking-tight">
                Conoce a nuestros <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-cyan-400">Mentores</span>
            </h1>
            <p class="text-slate-400 text-lg max-w-2xl mx-auto mb-8">
                Aprende de expertos líderes en la industria apasionados por compartir su conocimiento y experiencia.
            </p>
            
            <nav class="flex justify-center items-center text-sm font-medium text-slate-300 space-x-2">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">
                    <i class="fas fa-home"></i> Inicio
                </a>
                <span class="text-slate-600">/</span>
                <span class="text-indigo-400">Docentes</span>
            </nav>
        </div>
    </div>

    <div class="py-20 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if($teachers->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($teachers as $teacher)
                        <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 overflow-hidden text-center hover:-translate-y-2">
                            
                            <div class="h-24 bg-gradient-to-r from-slate-100 to-indigo-50 group-hover:from-indigo-500 group-hover:to-purple-600 transition-colors duration-500"></div>
                            
                            <div class="relative -mt-12 mb-4">
                                <div class="inline-block p-1 rounded-full bg-white shadow-md">
                                    <img src="{{ $teacher->profile_photo_url }}" 
                                         alt="{{ $teacher->name }}" 
                                         class="w-24 h-24 rounded-full object-cover">
                                </div>
                            </div>

                            <div class="px-6 pb-8">
                                <h3 class="text-lg font-bold text-slate-800 font-heading mb-1">{{ $teacher->name }}</h3>
                                <p class="text-indigo-600 text-xs font-bold uppercase tracking-wider mb-4">Instructor Senior</p>
                                
                                <p class="text-slate-500 text-sm mb-6 line-clamp-3 leading-relaxed">
                                    {{ $teacher->bio ?? 'Experto en desarrollo de software y tecnologías web con más de 10 años de experiencia en la industria educativa.' }}
                                </p>

                                <div class="flex justify-center items-center gap-6 border-t border-slate-100 pt-4 mb-4">
                                    <div class="text-center">
                                        <span class="block font-bold text-slate-800">{{ $teacher->courses_count }}</span>
                                        <span class="text-xs text-slate-400">Cursos</span>
                                    </div>
                                    <div class="w-px h-8 bg-slate-100"></div>
                                    <div class="text-center">
                                        <span class="block font-bold text-slate-800">4.9</span> <span class="text-xs text-slate-400">Rating</span>
                                    </div>
                                </div>

                                <div class="flex justify-center gap-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform translate-y-2 group-hover:translate-y-0">
                                    <a href="#" class="w-8 h-8 rounded-full bg-slate-50 text-slate-400 hover:bg-indigo-600 hover:text-white flex items-center justify-center transition"><i class="fab fa-linkedin-in text-xs"></i></a>
                                    <a href="#" class="w-8 h-8 rounded-full bg-slate-50 text-slate-400 hover:bg-sky-500 hover:text-white flex items-center justify-center transition"><i class="fab fa-twitter text-xs"></i></a>
                                    <a href="#" class="w-8 h-8 rounded-full bg-slate-50 text-slate-400 hover:bg-pink-600 hover:text-white flex items-center justify-center transition"><i class="fas fa-globe text-xs"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $teachers->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <div class="bg-indigo-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 text-indigo-500 text-3xl">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800">Aún no hay docentes registrados</h3>
                    <p class="text-slate-500 mt-2">Vuelve pronto para conocer a nuestro equipo.</p>
                </div>
            @endif
        </div>
    </div>

</x-web-layout>