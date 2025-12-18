<div class="space-y-8 text-slate-300">
    
    <div class="bg-slate-800 p-4 md:p-6 rounded-2xl border border-slate-700">
        <h4 class="font-bold text-white mb-4 flex items-center gap-2">
            <i class="fas fa-comment-dots text-indigo-400"></i> Foro de la clase
        </h4>
        
        <form wire:submit.prevent="postComment">
            <div class="mb-3">
                <textarea 
                    wire:model="body" 
                    rows="2" 
                    class="w-full bg-slate-900 border-slate-700 text-white rounded-xl focus:ring-indigo-500 focus:border-indigo-500 placeholder-slate-500 custom-scrollbar text-sm"
                    placeholder="Plantea una nueva duda o discusión..."></textarea>
                
                @error('body') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg text-xs transition flex items-center gap-2">
                    <i class="fas fa-paper-plane"></i> Publicar
                </button>
            </div>
        </form>
    </div>

    <div class="space-y-6">
        <h3 class="text-lg font-bold text-white mb-4">
            Debates <span class="text-slate-500 text-sm">({{ $comments->total() }})</span>
        </h3>

        @forelse($comments as $comment)
            <div class="animate-fade-in-up group">
                
                <div class="flex gap-3 md:gap-4">
                    <div class="flex-shrink-0">
                        <img class="h-8 w-8 md:h-10 md:w-10 rounded-full border border-slate-600 object-cover" 
                             src="{{ $comment->user->profile_photo_url }}" 
                             alt="{{ $comment->user->name }}">
                    </div>

                    <div class="flex-1 min-w-0"> <div class="flex flex-wrap items-center gap-2 mb-1">
                            <span class="font-bold text-white text-sm">{{ $comment->user->name }}</span>
                            @if($comment->user->isInstructor())
                                <span class="bg-indigo-500/20 text-indigo-300 text-[10px] px-1.5 rounded border border-indigo-500/30">Instructor</span>
                            @endif
                            <span class="text-xs text-slate-500">• {{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        
                        <div class="text-sm text-slate-300 bg-slate-800/50 p-3 rounded-tr-xl rounded-br-xl rounded-bl-xl border border-slate-700/50 mb-2 break-words">
                            {{ $comment->body }}
                        </div>

                        <div class="flex items-center gap-4 text-xs">
                            <button wire:click="setReply({{ $comment->id }})" class="text-slate-500 hover:text-indigo-400 font-bold transition">
                                Responder
                            </button>

                            @if(auth()->id() === $comment->user_id || auth()->user()->role === 'admin')
                                <button wire:click="delete({{ $comment->id }})" wire:confirm="¿Borrar este hilo?" class="text-slate-600 hover:text-red-400 transition">
                                    Eliminar
                                </button>
                            @endif
                        </div>

                        @if($replyingToId === $comment->id)
                            <div class="mt-3 ml-1 md:ml-2 animate-fade-in-down">
                                <form wire:submit.prevent="postReply">
                                    <textarea wire:model="replyBody" rows="2" class="w-full bg-slate-900 border-slate-700 text-white rounded-lg text-xs p-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Escribe tu respuesta..."></textarea>
                                    <div class="flex justify-end gap-2 mt-2">
                                        <button type="button" wire:click="cancelReply" class="text-xs text-slate-400 hover:text-white">Cancelar</button>
                                        <button type="submit" class="bg-indigo-600 text-white px-3 py-1 rounded text-xs font-bold hover:bg-indigo-500">Responder</button>
                                    </div>
                                </form>
                            </div>
                        @endif

                        @if($comment->replies->count() > 0)
                            <div class="mt-4 space-y-4 pl-2 md:pl-4 border-l-2 border-slate-800 ml-1 md:ml-2">
                                @foreach($comment->replies as $reply)
                                    <div class="flex gap-2 md:gap-3">
                                        <img class="h-6 w-6 md:h-8 md:w-8 rounded-full border border-slate-700 object-cover" src="{{ $reply->user->profile_photo_url }}" alt="{{ $reply->user->name }}">
                                        
                                        <div class="flex-1 min-w-0">
                                            <div class="flex flex-wrap items-center gap-2 mb-1">
                                                <span class="font-bold text-slate-200 text-xs">{{ $reply->user->name }}</span>
                                                @if($reply->user->isInstructor())
                                                    <span class="bg-indigo-500/20 text-indigo-300 text-[9px] px-1 rounded border border-indigo-500/30">Instructor</span>
                                                @endif
                                                <span class="text-[10px] text-slate-600">• {{ $reply->created_at->diffForHumans() }}</span>
                                            </div>
                                            
                                            <p class="text-xs text-slate-400 bg-slate-900/50 p-2 rounded-lg border border-slate-800 break-words">
                                                {{ $reply->body }}
                                            </p>

                                            @if(auth()->id() === $reply->user_id || auth()->user()->role === 'admin')
                                                <button wire:click="delete({{ $reply->id }})" wire:confirm="¿Borrar respuesta?" class="text-[10px] text-slate-600 hover:text-red-400 mt-1 ml-1">
                                                    Eliminar
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-10 bg-slate-800/30 rounded-xl border border-dashed border-slate-700">
                <i class="far fa-comments text-3xl text-slate-600 mb-2"></i>
                <p class="text-slate-500 text-sm">Aún no hay debates en esta clase.</p>
                <p class="text-slate-600 text-xs">¡Sé el primero en preguntar!</p>
            </div>
        @endforelse

        <div class="mt-4">
            {{ $comments->links(data: ['scrollTo' => false]) }}
        </div>
    </div>
</div>