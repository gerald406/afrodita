<x-web-layout>
    
    <div class="relative bg-slate-900 pt-32 pb-20 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-900 via-slate-900 to-black"></div>
        
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-96 h-96 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-2000"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-heading font-extrabold text-white mb-4 tracking-tight">
                Catálogo de <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-cyan-400">Cursos</span>
            </h1>
            <p class="text-slate-400 text-lg max-w-2xl mx-auto mb-8">
                Filtra por categoría o busca el tema que te interesa aprender hoy.
            </p>
            
            <nav class="flex justify-center items-center text-sm font-medium text-slate-300 space-x-2">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">
                    <i class="fas fa-home"></i> Inicio
                </a>
                <span class="text-slate-600">/</span>
                <span class="text-indigo-400">Catálogo</span>
            </nav>
        </div>
    </div>

    <div class="py-16 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @livewire('web.course-catalog')
        </div>
    </div>

</x-web-layout>