<div class="min-h-screen bg-slate-900 text-white font-sans">
    
    <div class="h-16 bg-slate-950 flex items-center justify-between px-6 border-b border-slate-800 fixed w-full z-50">
        <div class="flex items-center gap-4">
            <a href="{{ route('student.my-courses') }}" class="text-slate-400 hover:text-white transition">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <div class="h-6 w-px bg-slate-700"></div>
            <h1 class="font-bold text-lg truncate max-w-xl">{{ $course->title }}</h1>
        </div>
        <div class="flex items-center gap-6">
            <div class="flex items-center gap-2 text-yellow-400 font-bold bg-yellow-400/10 px-3 py-1 rounded-full">
                <i class="fas fa-trophy"></i>
                <span>{{ Auth::user()->total_points }} XP</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-xs text-slate-400">Progreso:</span>
                <span class="font-bold text-indigo-400">{{ $course->progress }}%</span>
            </div>
        </div>
    </div>

    <div class="pt-16 flex flex-col lg:flex-row h-screen">
        
        <div class="lg:w-[70%] w-full flex flex-col h-full overflow-y-auto bg-slate-900 custom-scrollbar">
            
            <div class="w-full aspect-video bg-black relative shadow-2xl z-10">
                <div wire:ignore> @if(Str::startsWith($currentLesson->video_iframe, '<iframe'))
                        <div class="plyr__video-embed" id="player">
                            {!! $currentLesson->video_iframe !!}
                        </div>
                    @else
                        <video id="player" playsinline controls data-poster="{{ $course->image_path }}">
                            <source src="{{ $currentLesson->video_url }}" type="video/mp4" />
                        </video>
                    @endif
                </div>
            </div>

            <div class="p-8 max-w-5xl mx-auto w-full flex-1">
                
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold text-white">{{ $currentLesson->title }}</h2>
                    
                    <div class="flex gap-3">
                        @if($this->previousLesson)
                            <button wire:click="changeLesson({{ $this->previousLesson->id }})" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 rounded-lg text-sm font-bold transition">
                                <i class="fas fa-chevron-left mr-1"></i> Anterior
                            </button>
                        @endif
                        @if($this->nextLesson)
                            <button wire:click="changeLesson({{ $this->nextLesson->id }})" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 rounded-lg text-sm font-bold transition">
                                Siguiente <i class="fas fa-chevron-right ml-1"></i>
                            </button>
                        @endif
                    </div>
                </div>

                <div class="mb-6 border-b border-slate-700">
                    <nav class="-mb-px flex space-x-8">
                        <button wire:click="$set('activeTab', 'options')" class="pb-4 px-1 border-b-2 font-medium text-sm transition-colors {{ $activeTab === 'options' ? 'border-indigo-500 text-indigo-400' : 'border-transparent text-slate-400 hover:text-slate-300' }}">
                            <i class="fas fa-play-circle mr-2"></i> Opciones de Lección
                        </button>
                        <button wire:click="$set('activeTab', 'comments')" class="pb-4 px-1 border-b-2 font-medium text-sm transition-colors {{ $activeTab === 'comments' ? 'border-indigo-500 text-indigo-400' : 'border-transparent text-slate-400 hover:text-slate-300' }}">
                            <i class="fas fa-comments mr-2"></i> Comentarios
                        </button>
                    </nav>
                </div>

                <div>
                    @if($activeTab === 'options')
                        <div class="animate-fade-in-up">
                            
                            <div class="bg-slate-800 p-6 rounded-2xl border border-slate-700 flex justify-between items-center mb-6">
                                <div>
                                    <h4 class="font-bold text-white mb-1">Progreso de la lección</h4>
                                    <p class="text-sm text-slate-400">Marca esta clase cuando la hayas terminado para ganar puntos.</p>
                                </div>
                                @if($currentLesson->users->contains(Auth::id()))
                                    <button disabled class="px-6 py-3 bg-green-500/20 text-green-400 font-bold rounded-xl cursor-default border border-green-500/50">
                                        <i class="fas fa-check-circle mr-2"></i> Completada
                                    </button>
                                @else
                                    <button wire:click="markAsCompleted" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg hover:shadow-indigo-500/30 transition transform hover:-translate-y-0.5">
                                        Marcar como Terminada <i class="fas fa-check ml-2"></i>
                                    </button>
                                @endif
                            </div>

                            @if($currentLesson->resources && $currentLesson->resources->count() > 0)
                                <h3 class="font-bold text-white mb-4">Recursos Descargables</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach($currentLesson->resources as $resource)
                                        <a href="{{ $resource->path_or_url }}" target="_blank" class="flex items-center p-4 bg-slate-800 rounded-xl hover:bg-slate-700 transition border border-slate-700 group">
                                            <div class="w-10 h-10 rounded-lg bg-indigo-500/20 text-indigo-400 flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                                                <i class="fas fa-download"></i>
                                            </div>
                                            <div>
                                                <p class="font-bold text-sm text-white">{{ $resource->title }}</p>
                                                <p class="text-xs text-slate-400 uppercase">{{ $resource->type }}</p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif

                    @if($activeTab === 'comments')
                        <div class="animate-fade-in-up">
                            <livewire:student.lesson-comments :lesson="$currentLesson" :key="'comments-'.$currentLesson->id" />
                        </div>
                    @endif
                </div>

            </div>
        </div>

        <div class="lg:w-[30%] w-full bg-slate-950 border-l border-slate-800 h-full overflow-y-auto custom-scrollbar">
            <div class="p-6 sticky top-0 bg-slate-950 z-10 border-b border-slate-800">
                <h3 class="font-bold text-white mb-2">Contenido del Curso</h3>
                <div class="w-full bg-slate-800 rounded-full h-1.5 mb-2">
                    <div class="bg-green-500 h-1.5 rounded-full transition-all duration-500" style="width: {{ $course->progress }}%"></div>
                </div>
                <p class="text-xs text-slate-400 text-right">{{ $course->progress }}% Completado</p>
            </div>

            <div class="p-4 space-y-4">
                @foreach($course->sections as $section)
                    <div x-data="{ open: true }">
                        <button @click="open = !open" class="w-full flex justify-between items-center text-left py-2 px-2 text-slate-300 hover:text-white font-bold text-sm">
                            <span>{{ $section->title }}</span>
                            <i class="fas fa-chevron-down text-xs transition-transform" :class="{'rotate-180': !open}"></i>
                        </button>

                        <div x-show="open" class="space-y-1 mt-1">
                            @foreach($section->lessons as $lesson)
                                @php
                                    $isCompleted = $lesson->users->contains(Auth::id());
                                    $isCurrent = $currentLesson->id == $lesson->id;
                                @endphp
                                
                                <button wire:click="changeLesson({{ $lesson->id }})" 
                                        class="w-full flex items-center gap-3 p-3 rounded-lg text-left transition-all relative overflow-hidden group
                                        {{ $isCurrent ? 'bg-indigo-600/20 border border-indigo-500/50' : 'hover:bg-slate-800 border border-transparent' }}">
                                    
                                    <div class="flex-shrink-0">
                                        @if($isCompleted)
                                            <div class="w-6 h-6 rounded-full bg-green-500 flex items-center justify-center text-white text-xs shadow-lg shadow-green-500/40">
                                                <i class="fas fa-check"></i>
                                            </div>
                                        @else
                                            <div class="w-6 h-6 rounded-full border-2 {{ $isCurrent ? 'border-indigo-400 text-indigo-400' : 'border-slate-600 text-slate-600' }} flex items-center justify-center text-[10px]">
                                                @if($isCurrent) <i class="fas fa-play"></i> @else {{ $loop->iteration }} @endif
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium truncate {{ $isCurrent ? 'text-indigo-300' : ($isCompleted ? 'text-slate-400' : 'text-slate-300') }}">
                                            {{ $lesson->title }}
                                        </p>
                                        <div class="flex items-center gap-2 text-[10px] text-slate-500 mt-0.5">
                                            <span><i class="far fa-clock"></i> {{ $lesson->duration_minutes }} min</span>
                                            @if($lesson->resources->count() > 0)
                                                <span class="text-indigo-400"><i class="fas fa-paperclip"></i> Recursos</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    @if($isCurrent)
                                        <div class="absolute right-0 top-0 bottom-0 w-1 bg-indigo-500"></div>
                                    @endif
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @assets
        <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
        <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
    @endassets

    <script>
        document.addEventListener('livewire:initialized', () => {
            // Inicializar Plyr
            const player = new Plyr('#player', {
                title: '{{ $currentLesson->title }}',
                controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'captions', 'settings', 'pip', 'airplay', 'fullscreen'],
            });

            // Escuchar evento de cambio de lección para actualizar video
            Livewire.on('lesson-changed', (url) => {
                player.source = {
                    type: 'video',
                    sources: [
                        {
                            src: url,
                            provider: url.includes('youtube') ? 'youtube' : (url.includes('vimeo') ? 'vimeo' : 'html5'),
                        },
                    ],
                };
            });
        });
    </script>

    <style>
        /* Scrollbar personalizado oscuro */
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #0f172a; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; border-radius: 3px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #475569; }
    </style>
</div>