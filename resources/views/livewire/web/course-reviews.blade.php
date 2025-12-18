<div>
    <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
        <i class="fas fa-star text-yellow-400"></i> 
        Reseñas del Curso 
        <span class="text-base font-normal text-gray-500">({{ $course->reviews->count() }})</span>
    </h3>

    @auth
        @if($canReview)
            <div class="bg-indigo-50/50 p-6 rounded-2xl border border-indigo-100 mb-10">
                <h4 class="font-bold text-slate-800 mb-2">
                    {{ $userReview ? 'Edita tu reseña' : 'Deja tu opinión' }}
                </h4>
                <p class="text-sm text-slate-500 mb-4">Tu experiencia ayuda a otros estudiantes a decidir.</p>

                <form wire:submit.prevent="save">
                    <div class="mb-4">
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tu calificación</label>
                        <div class="flex items-center gap-1 text-2xl cursor-pointer">
                            @for($i=1; $i<=5; $i++)
                                <button type="button" wire:click="$set('rating', {{ $i }})" class="focus:outline-none transition-transform hover:scale-110">
                                    <i class="fas fa-star {{ $rating >= $i ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                </button>
                            @endfor
                            <span class="ml-3 text-sm font-bold text-indigo-600 bg-white px-2 py-1 rounded shadow-sm border border-indigo-100">
                                {{ $rating }} / 5
                            </span>
                        </div>
                        @error('rating') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tu comentario</label>
                        <textarea wire:model="comment" rows="3" 
                                  class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                  placeholder="¿Qué te pareció el curso? ¿Qué aprendiste?"></textarea>
                        @error('comment') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg transition shadow-md text-sm">
                            {{ $userReview ? 'Actualizar Reseña' : 'Publicar Reseña' }}
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 mb-8 text-center">
                <p class="text-gray-500 text-sm">Debes estar inscrito en este curso para dejar una reseña.</p>
            </div>
        @endif
    @else
        <div class="bg-gray-50 p-6 rounded-xl border border-gray-100 mb-8 text-center">
            <p class="text-gray-600">Inicia sesión y adquiere el curso para compartir tu experiencia.</p>
            <a href="{{ route('login') }}" class="inline-block mt-3 text-indigo-600 font-bold hover:underline">Ir a Iniciar Sesión</a>
        </div>
    @endauth

    <div class="space-y-6">
        @forelse($reviews as $review)
            <div class="flex gap-4 p-4 bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full object-cover border border-gray-200" 
                         src="{{ $review->user->profile_photo_url }}" 
                         alt="{{ $review->user->name }}">
                </div>
                
                <div class="flex-1">
                    <div class="flex justify-between items-start mb-1">
                        <div>
                            <h5 class="font-bold text-gray-900 text-sm">{{ $review->user->name }}</h5>
                            <span class="text-xs text-gray-400">{{ $review->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="flex text-yellow-400 text-xs">
                            @for($i=1; $i<=5; $i++)
                                <i class="fas fa-star {{ $review->rating >= $i ? '' : 'text-gray-200' }}"></i>
                            @endfor
                        </div>
                    </div>
                    
                    <p class="text-gray-600 text-sm leading-relaxed">
                        {{ $review->comment }}
                    </p>
                </div>
            </div>
        @empty
            <div class="text-center py-10">
                <div class="inline-block p-3 rounded-full bg-yellow-50 text-yellow-500 mb-3">
                    <i class="far fa-star text-2xl"></i>
                </div>
                <p class="text-gray-500 font-medium">Este curso aún no tiene reseñas.</p>
                <p class="text-gray-400 text-sm">¡Sé el primero en opinar!</p>
            </div>
        @endforelse

        <div class="mt-6">
            {{ $reviews->links() }}
        </div>
    </div>
</div>