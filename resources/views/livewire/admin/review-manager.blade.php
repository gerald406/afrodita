<div class="bg-white shadow-xl sm:rounded-lg border border-gray-100 p-6">
    <h3 class="text-lg font-bold mb-4">Moderación de Reseñas</h3>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Usuario</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Curso</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Calificación / Comentario</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                    <th class="px-6 py-3 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($reviews as $review)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $review->user->name }}</td>
                        <td class="px-6 py-4 text-sm">{{ Str::limit($review->course->title, 20) }}</td>
                        <td class="px-6 py-4 text-sm">
                            <div class="text-yellow-400 font-bold"><i class="fas fa-star"></i> {{ $review->rating }}</div>
                            <p class="text-gray-500 text-xs mt-1">{{ Str::limit($review->comment, 50) }}</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button wire:click="toggleApproval({{ $review->id }})" 
                                class="px-2 py-1 text-xs font-bold rounded-full {{ $review->is_approved ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $review->is_approved ? 'Aprobado' : 'Pendiente/Oculto' }}
                            </button>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button wire:click="delete({{ $review->id }})" onclick="confirm('¿Eliminar?') || event.stopImmediatePropagation()" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $reviews->links() }}</div>
</div>