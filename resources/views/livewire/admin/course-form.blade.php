<div>
    <div class="mb-6 border-b border-gray-200 bg-white rounded-t-lg px-4 pt-4 shadow-sm">
        <nav class="-mb-px flex space-x-8">
            <button wire:click="$set('activeTab', 'info')"
                class="whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm transition-colors focus:outline-none
                {{ $activeTab === 'info' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                <i class="fas fa-info-circle mr-2"></i> Información Básica
            </button>

            @if($course)
                <button wire:click="$set('activeTab', 'curriculum')"
                    class="whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm transition-colors focus:outline-none
                    {{ $activeTab === 'curriculum' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    <i class="fas fa-list-ul mr-2"></i> Temario (Constructor)
                </button>
            @else
                <span class="whitespace-nowrap pb-4 px-1 border-b-2 border-transparent font-medium text-sm text-gray-300 cursor-not-allowed" 
                      title="Guarda la información básica primero para editar el contenido">
                    <i class="fas fa-lock mr-2"></i> Temario
                </span>
            @endif
        </nav>
    </div>

    <div class="{{ $activeTab === 'info' ? 'block' : 'hidden' }}">
        <div class="bg-white shadow-xl sm:rounded-lg p-6 border border-gray-100">
            <form wire:submit="saveInfo" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700">Título del Curso</label>
                        <input wire:model.live="title" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700">Slug (URL Amigable)</label>
                        <input wire:model="slug" type="text" class="mt-1 block w-full bg-gray-50 rounded-md border-gray-300 text-gray-500 cursor-not-allowed" readonly>
                        @error('slug') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700">Precio Actual</label>
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-gray-500 sm:text-sm">$</span>
                                </div>
                                <input wire:model="price" type="number" step="0.01" class="block w-full rounded-md border-gray-300 pl-7 focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            @error('price') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700">Precio Anterior (Opcional)</label>
                            <input wire:model="compare_price" type="number" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700">Estado de Publicación</label>
                        <select wire:model="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500">
                            <option value="draft">Borrador (Oculto)</option>
                            <option value="published">Publicado (Visible)</option>
                            <option value="archived">Archivado</option>
                        </select>
                        @error('status') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700">Categoría</label>
                        <select wire:model="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">-- Seleccionar Categoría --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700">Asignar Docente</label>
                        <select wire:model="user_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }} ({{ $teacher->dni }})</option>
                            @endforeach
                        </select>
                        @error('user_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700">Imagen de Portada</label>
                        <div class="mt-2 flex flex-col gap-4">
                            <div class="w-full h-48 bg-gray-100 rounded-lg overflow-hidden border border-gray-200 flex items-center justify-center relative group">
                                @if ($newImage)
                                    <img src="{{ $newImage->temporaryUrl() }}" class="object-cover w-full h-full">
                                @elseif($image)
                                    <img src="{{ $image }}" class="object-cover w-full h-full">
                                @else
                                    <div class="text-center p-4">
                                        <i class="fas fa-image text-4xl text-gray-300 mb-2"></i>
                                        <p class="text-xs text-gray-400">Sin imagen</p>
                                    </div>
                                @endif
                                
                                <div wire:loading wire:target="newImage" class="absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center">
                                    <i class="fas fa-spinner fa-spin text-indigo-600 text-2xl"></i>
                                </div>
                            </div>
                            
                            <label class="block w-full">
                                <span class="sr-only">Elegir imagen</span>
                                <input wire:model="newImage" type="file" accept="image/*" class="block w-full text-sm text-gray-500
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-full file:border-0
                                  file:text-xs file:font-semibold
                                  file:bg-indigo-50 file:text-indigo-700
                                  hover:file:bg-indigo-100 cursor-pointer
                                "/>
                            </label>
                            @error('newImage') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700">Descripción Completa</label>
                        <textarea wire:model="description" rows="6" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                    </div>
                </div>

                <div class="col-span-1 md:col-span-2 flex justify-end pt-4 border-t border-gray-100">
                    <button type="submit" class="inline-flex justify-center items-center rounded-md border border-transparent bg-indigo-600 py-2 px-6 text-sm font-bold text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all">
                        <i class="fas fa-save mr-2"></i> 
                        {{ $course ? 'Guardar Cambios' : 'Crear Curso' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="{{ $activeTab === 'curriculum' ? 'block' : 'hidden' }}">
        
        <div class="bg-white p-4 rounded-lg shadow-sm mb-6 border border-gray-200">
            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Crear Nuevo Módulo / Sección</label>
            <div class="flex gap-2">
                <input wire:model="sectionTitle" type="text" placeholder="Ej: Unidad 1: Fundamentos..." 
                       class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                       wire:keydown.enter="addSection">
                <button wire:click="addSection" class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700 text-sm font-bold shadow-sm transition-colors whitespace-nowrap">
                    <i class="fas fa-plus mr-1"></i> Agregar Sección
                </button>
            </div>
            @error('sectionTitle') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        @if($course)
            <div class="space-y-4">
                @forelse($course->sections as $section)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden transition-all duration-200" x-data="{ open: true }">
                        
                        <div class="bg-gray-50 px-4 py-3 flex justify-between items-center border-b border-gray-200 hover:bg-gray-100 transition-colors">
                            <div class="flex items-center gap-3 cursor-pointer select-none flex-1" @click="open = !open">
                                <i class="fas fa-chevron-right text-gray-400 text-xs transition-transform duration-200" :class="{'rotate-90': open}"></i>
                                <h3 class="font-bold text-gray-800 text-sm md:text-base">{{ $section->title }}</h3>
                                <span class="text-xs text-gray-400 font-normal">({{ $section->lessons->count() }} lecciones)</span>
                            </div>
                            
                            <div class="flex items-center gap-2">
                                <button wire:click="createLesson({{ $section->id }})" class="text-indigo-600 hover:text-indigo-800 text-xs font-bold uppercase tracking-wider px-2 py-1 rounded hover:bg-indigo-50 transition mr-2">
                                    <i class="fas fa-plus-circle mr-1"></i> Lección
                                </button>
                                
                                <button onclick="confirmDelete({{ $section->id }}, 'section', 'deleteSection')" class="text-gray-400 hover:text-red-500 transition px-2">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>

                        <div x-show="open" x-collapse class="bg-white">
                            
                            @if($section->lessons->count() > 0)
                                <div class="divide-y divide-gray-100">
                                    @foreach($section->lessons as $lesson)
                                        <div class="flex flex-col md:flex-row md:justify-between md:items-center px-6 py-3 hover:bg-gray-50 transition group">
                                            
                                            <div class="flex items-start gap-3 mb-2 md:mb-0">
                                                <div class="mt-1 bg-indigo-100 text-indigo-600 w-6 h-6 flex items-center justify-center rounded-full text-[10px] flex-shrink-0">
                                                    <i class="fas fa-play"></i>
                                                </div>
                                                <div>
                                                    <span class="text-sm font-medium text-gray-700 block group-hover:text-indigo-600 transition-colors">
                                                        {{ $lesson->title }}
                                                    </span>
                                                    <div class="flex items-center gap-2 text-xs text-gray-400 mt-0.5">
                                                        <span><i class="far fa-clock mr-1"></i> {{ $lesson->duration_minutes }} min</span>
                                                        @if($lesson->is_free)
                                                            <span class="bg-green-100 text-green-700 px-1.5 rounded text-[10px] font-bold">GRATIS</span>
                                                        @endif
                                                        @if($lesson->video_iframe)
                                                            <span class="bg-purple-100 text-purple-700 px-1.5 rounded text-[10px] font-bold">EMBED</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="flex items-center gap-3 pl-9 md:pl-0">
                                                <button wire:click="editLesson({{ $lesson->id }})" class="text-gray-400 hover:text-indigo-600 text-sm" title="Editar">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>
                                                <button onclick="confirmDelete({{ $lesson->id }}, 'lesson', 'deleteLesson')" class="text-gray-400 hover:text-red-600 text-sm" title="Eliminar">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="p-4 text-center text-sm text-gray-400 italic">
                                    No hay lecciones en este módulo. ¡Agrega una!
                                </div>
                            @endif

                            @if($currentSectionId === $section->id)
                                <div class="border-t-2 border-indigo-100 bg-indigo-50/50 p-6 animate-fade-in-down">
                                    <div class="flex justify-between items-center mb-4">
                                        <h4 class="text-xs font-bold text-indigo-600 uppercase tracking-wider">
                                            {{ $lessonId ? 'Editando Lección' : 'Nueva Lección' }}
                                        </h4>
                                        <button wire:click="resetLessonForm" class="text-gray-400 hover:text-gray-600">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                        
                                        <div class="md:col-span-6">
                                            <label class="block text-xs font-semibold text-gray-600 mb-1">Título de la lección</label>
                                            <input wire:model="lessonTitle" type="text" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                            @error('lessonTitle') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="md:col-span-2">
                                            <label class="block text-xs font-semibold text-gray-600 mb-1">Minutos</label>
                                            <input wire:model="lessonDuration" type="number" min="0" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                            @error('lessonDuration') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="md:col-span-4 flex items-center pt-5">
                                            <label class="flex items-center space-x-2 cursor-pointer select-none">
                                                <input wire:model="lessonIsFree" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 h-4 w-4">
                                                <span class="text-sm text-gray-700 font-medium">Vista Previa Gratuita</span>
                                            </label>
                                        </div>

                                        <div class="md:col-span-12">
                                            <label class="block text-xs font-semibold text-gray-600 mb-1">Video (URL directa o Código Iframe)</label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <i class="fas fa-video text-gray-400 text-xs"></i>
                                                </div>
                                                <input wire:model="lessonVideoSource" type="text" class="block w-full rounded-md border-gray-300 pl-8 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" placeholder="https://youtube.com/... o <iframe...">
                                            </div>
                                            <p class="text-[10px] text-gray-400 mt-1">Soporta enlaces directos de YouTube/Vimeo o códigos de inserción HTML completos.</p>
                                            @error('lessonVideoSource') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                    </div>

                                    @if($lessonId)
                                        <div class="mt-6 pt-4 border-t border-indigo-100">
                                            <h5 class="text-xs font-bold text-gray-500 uppercase mb-3 flex items-center">
                                                <i class="fas fa-paperclip mr-2"></i> Material Adjunto
                                            </h5>
                                            
                                            <div class="space-y-2 mb-4">
                                                @forelse(\App\Models\Lesson::find($lessonId)->resources as $resource)
                                                    <div class="flex items-center justify-between bg-white border border-gray-200 rounded px-3 py-2 text-sm shadow-sm">
                                                        <div class="flex items-center gap-3 overflow-hidden">
                                                            @if($resource->type == 'pdf') 
                                                                <i class="fas fa-file-pdf text-red-500 text-lg"></i>
                                                            @elseif($resource->type == 'link') 
                                                                <i class="fas fa-link text-blue-500 text-lg"></i>
                                                            @elseif($resource->type == 'zip') 
                                                                <i class="fas fa-file-archive text-yellow-500 text-lg"></i>
                                                            @else 
                                                                <i class="fas fa-file text-gray-400 text-lg"></i> 
                                                            @endif
                                                            
                                                            <a href="{{ $resource->path_or_url }}" target="_blank" class="text-gray-700 hover:text-indigo-600 truncate font-medium">
                                                                {{ $resource->title }}
                                                            </a>
                                                        </div>
                                                        <button onclick="confirmDelete({{ $resource->id }}, 'resource', 'deleteResource')" class="text-gray-400 hover:text-red-500">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                @empty
                                                    <p class="text-xs text-gray-400 italic">No hay recursos adjuntos.</p>
                                                @endforelse
                                            </div>

                                            <div class="bg-gray-100 p-3 rounded-md">
                                                <div class="flex flex-col md:flex-row gap-2 items-end">
                                                    <div class="w-full md:w-1/4">
                                                        <label class="text-[10px] font-bold text-gray-500 uppercase">Tipo</label>
                                                        <select wire:model.live="resourceType" class="block w-full rounded border-gray-300 text-xs py-1.5 focus:ring-indigo-500 focus:border-indigo-500">
                                                            <option value="pdf">PDF</option>
                                                            <option value="link">Link externo</option>
                                                            <option value="zip">Zip / Rar</option>
                                                            <option value="image">Imagen</option>
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="w-full md:w-1/3">
                                                        <label class="text-[10px] font-bold text-gray-500 uppercase">Nombre</label>
                                                        <input wire:model="resourceTitle" type="text" placeholder="Ej: Diapositivas" class="block w-full rounded border-gray-300 text-xs py-1.5 focus:ring-indigo-500 focus:border-indigo-500">
                                                    </div>

                                                    <div class="flex-1 w-full">
                                                        <label class="text-[10px] font-bold text-gray-500 uppercase">Archivo / URL</label>
                                                        @if($resourceType === 'link')
                                                            <input wire:model="resourceUrl" type="text" placeholder="https://..." class="block w-full rounded border-gray-300 text-xs py-1.5 focus:ring-indigo-500 focus:border-indigo-500">
                                                        @else
                                                            <input wire:model="resourceFile" type="file" class="block w-full text-xs text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-300 cursor-pointer">
                                                        @endif
                                                    </div>

                                                    <button wire:click="addResource" class="bg-gray-800 text-white px-3 py-1.5 rounded hover:bg-gray-700 transition text-xs font-bold h-8 flex items-center">
                                                        <i class="fas fa-upload mr-1"></i> Añadir
                                                    </button>
                                                </div>
                                                
                                                <div class="mt-1">
                                                    @error('resourceTitle') <span class="text-red-500 text-[10px] block">{{ $message }}</span> @enderror
                                                    @error('resourceFile') <span class="text-red-500 text-[10px] block">{{ $message }}</span> @enderror
                                                    @error('resourceUrl') <span class="text-red-500 text-[10px] block">{{ $message }}</span> @enderror
                                                </div>
                                                
                                                <div wire:loading wire:target="resourceFile" class="text-xs text-indigo-600 mt-1 font-semibold">
                                                    <i class="fas fa-spinner fa-spin mr-1"></i> Subiendo archivo...
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="mt-4 p-3 bg-yellow-50 border border-yellow-100 rounded text-xs text-yellow-700 flex items-center">
                                            <i class="fas fa-info-circle mr-2 text-yellow-500"></i>
                                            Guarda la lección primero para poder adjuntar materiales.
                                        </div>
                                    @endif

                                    <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-indigo-100">
                                        <button wire:click="resetLessonForm" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none">
                                            Cancelar
                                        </button>
                                        <button wire:click="saveLesson" class="px-4 py-2 text-sm font-bold text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                            {{ $lessonId ? 'Actualizar Lección' : 'Guardar Lección' }}
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 bg-white rounded-lg border-2 border-dashed border-gray-300">
                        <i class="fas fa-layer-group text-gray-300 text-4xl mb-3"></i>
                        <p class="text-gray-500 font-medium">Aún no hay módulos en este curso.</p>
                        <p class="text-gray-400 text-sm">Empieza escribiendo un título arriba.</p>
                    </div>
                @endforelse
            </div>
        @endif
    </div>
</div>