<div class="space-y-6">
    <div class="flex justify-between items-center bg-white p-4 rounded-lg shadow-sm border border-gray-100">
        <h2 class="text-lg font-bold text-gray-800">Sliders del Home</h2>
        <button wire:click="create" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm font-bold hover:bg-indigo-700">
            <i class="fas fa-plus mr-2"></i> Nuevo Slider
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($sliders as $slider)
            <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200 group">
                <div class="relative h-40 bg-gray-100">
                    <img src="{{ $slider->image_path }}" class="w-full h-full object-cover">
                    <div class="absolute top-2 right-2 flex gap-1">
                        <span class="bg-black/50 text-white text-xs px-2 py-1 rounded">Orden: {{ $slider->sort_order }}</span>
                        @if($slider->is_active)
                            <span class="bg-green-500 text-white text-xs px-2 py-1 rounded">Activo</span>
                        @else
                            <span class="bg-red-500 text-white text-xs px-2 py-1 rounded">Inactivo</span>
                        @endif
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-gray-800 truncate">{{ $slider->title ?? 'Sin título' }}</h3>
                    <p class="text-xs text-gray-500 truncate">{{ $slider->subtitle }}</p>
                    
                    <div class="mt-4 flex justify-between items-center pt-2 border-t border-gray-100">
                        <button wire:click="edit({{ $slider->id }})" class="text-indigo-600 text-sm hover:underline">Editar</button>
                        <button onclick="confirm('¿Eliminar?') || event.stopImmediatePropagation()" wire:click="delete({{ $slider->id }})" class="text-red-500 text-sm hover:underline">Eliminar</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <x-dialog-modal wire:model="showModal">
        <x-slot name="title">{{ $sliderId ? 'Editar Slider' : 'Nuevo Slider' }}</x-slot>
        <x-slot name="content">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700">Imagen (Recomendado 1920x600)</label>
                    @if($newImage)
                        <img src="{{ $newImage->temporaryUrl() }}" class="h-32 w-full object-cover rounded mb-2">
                    @elseif($image)
                        <img src="{{ $image }}" class="h-32 w-full object-cover rounded mb-2">
                    @endif
                    <input wire:model="newImage" type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-indigo-50 file:text-indigo-700">
                    @error('newImage') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700">Título</label>
                        <input wire:model="title" type="text" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700">Orden</label>
                        <input wire:model="sort_order" type="number" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700">Subtítulo</label>
                    <input wire:model="subtitle" type="text" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700">Enlace (Botón)</label>
                    <input wire:model="link_url" type="text" placeholder="https://..." class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500">
                </div>
                
                <div class="flex items-center">
                    <input wire:model="is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 h-5 w-5">
                    <label class="ml-2 text-sm text-gray-700">Mostrar en el sitio web</label>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('showModal', false)">Cancelar</x-secondary-button>
            <x-button class="ml-2 bg-indigo-600" wire:click="save">Guardar</x-button>
        </x-slot>
    </x-dialog-modal>
</div>