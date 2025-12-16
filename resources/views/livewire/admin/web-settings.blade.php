<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow-xl sm:rounded-lg p-6 border border-gray-100">
        <form wire:submit="save" class="space-y-8">
            
            <div>
                <h3 class="text-lg font-bold text-gray-900 border-b pb-2 mb-4">Identidad del Sitio</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-gray-700">Nombre de la Web</label>
                        <input wire:model="site_name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('site_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Logo Principal</label>
                        <div class="flex items-center gap-4">
                            <div class="w-32 h-32 bg-gray-100 border border-gray-200 rounded-lg flex items-center justify-center overflow-hidden relative">
                                @if($newLogo)
                                    <img src="{{ $newLogo->temporaryUrl() }}" class="object-contain w-full h-full">
                                @elseif($site_logo)
                                    <img src="{{ $site_logo }}" class="object-contain w-full h-full">
                                @else
                                    <span class="text-gray-400 text-xs">Sin logo</span>
                                @endif
                                
                                <div wire:loading wire:target="newLogo" class="absolute inset-0 bg-white/80 flex items-center justify-center">
                                    <i class="fas fa-spinner fa-spin text-indigo-600"></i>
                                </div>
                            </div>
                            <label class="cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none">
                                Cambiar
                                <input wire:model="newLogo" type="file" class="hidden" accept="image/*">
                            </label>
                        </div>
                        @error('newLogo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Favicon (Icono pestaña)</label>
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 bg-gray-100 border border-gray-200 rounded-lg flex items-center justify-center overflow-hidden relative">
                                @if($newFavicon)
                                    <img src="{{ $newFavicon->temporaryUrl() }}" class="object-contain w-full h-full">
                                @elseif($site_favicon)
                                    <img src="{{ $site_favicon }}" class="object-contain w-full h-full">
                                @else
                                    <i class="fas fa-globe text-gray-400"></i>
                                @endif
                            </div>
                            <label class="cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none">
                                Subir
                                <input wire:model="newFavicon" type="file" class="hidden" accept="image/*">
                            </label>
                        </div>
                        @error('newFavicon') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-bold text-gray-900 border-b pb-2 mb-4">Popup de Comunicados</h3>
                
                <div class="space-y-4">
                    <div class="flex items-center">
                        <input wire:model="popup_active" type="checkbox" id="popup_active" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="popup_active" class="ml-2 block text-sm text-gray-900 font-bold">Activar Popup al inicio</label>
                    </div>

                    <div x-data="{ active: @entangle('popup_active') }" x-show="active" x-transition class="space-y-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Imagen del Comunicado</label>
                            @if($newPopupImage)
                                <img src="{{ $newPopupImage->temporaryUrl() }}" class="h-40 w-auto object-cover rounded mb-2 border">
                            @elseif($popup_image)
                                <img src="{{ $popup_image }}" class="h-40 w-auto object-cover rounded mb-2 border">
                            @endif
                            <input wire:model="newPopupImage" type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            @error('newPopupImage') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Enlace al dar clic (Opcional)</label>
                            <input wire:model="popup_link" type="text" placeholder="https://..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>
                </div>
            </div>
            <div>

            <h3 class="text-lg font-bold text-gray-900 border-b pb-2 mt-4 mb-4 flex items-center">
                <i class="fas fa-gift text-pink-500 mr-2"></i> Campaña de Acceso Gratuito
            </h3>
    
            <div class="bg-pink-50 p-4 rounded-lg border border-pink-100 space-y-4">
                <div class="flex items-center">
                    <input wire:model="free_mode_active" type="checkbox" id="free_mode_active" class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300 rounded">
                    <label for="free_mode_active" class="ml-2 block text-sm font-bold text-gray-900">Activar "Modo Puertas Abiertas"</label>
                </div>
                
                <p class="text-xs text-gray-500">
                    Cuando está activo, <strong>todos los cursos son accesibles</strong> para cualquier usuario registrado, tengan o no matrícula.
                </p>

                <div x-data="{ active: @entangle('free_mode_active') }" x-show="active" x-transition class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Fecha/Hora Inicio</label>
                        <input wire:model="free_mode_start" type="datetime-local" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Fecha/Hora Fin</label>
                        <input wire:model="free_mode_end" type="datetime-local" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Mensaje de Barra Superior</label>
                        <input wire:model="free_mode_message" type="text" placeholder="Ej: ¡Aprovecha! Acceso total por 24 horas." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                    </div>
                </div>
            </div>
        

            <div class="pt-4 border-t border-gray-100 flex justify-end">
                <button type="submit" wire:loading.attr="disabled" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <span wire:loading.remove>Guardar Configuración</span>
                    <span wire:loading><i class="fas fa-spinner fa-spin mr-2"></i> Guardando...</span>
                </button>
            </div>

        </form>
    </div>
</div>