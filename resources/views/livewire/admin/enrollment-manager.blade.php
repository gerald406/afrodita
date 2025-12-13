<div class="space-y-6">
    
    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="flex space-x-1 bg-gray-100 p-1 rounded-lg">
            <button wire:click="$set('activeTab', 'pending')" class="px-4 py-2 text-sm font-medium rounded-md transition-all {{ $activeTab === 'pending' ? 'bg-white text-indigo-600 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">
                <i class="fas fa-clock mr-2"></i> Pendientes
            </button>
            <button wire:click="$set('activeTab', 'active')" class="px-4 py-2 text-sm font-medium rounded-md transition-all {{ $activeTab === 'active' ? 'bg-white text-indigo-600 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">
                <i class="fas fa-list mr-2"></i> Historial
            </button>
        </div>
        <button wire:click="$set('showManualModal', true)" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
            <i class="fas fa-plus mr-2"></i> Matrícula Manual
        </button>
    </div>

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex gap-4 flex-1">
            <div class="relative w-full sm:w-64">
                <input wire:model.live.debounce.300ms="search" type="text" class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Buscar estudiante...">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400"><i class="fas fa-search"></i></div>
            </div>
            @if($activeTab === 'active')
                <select wire:model.live="courseFilter" class="rounded-md border-gray-300 shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500 w-full sm:w-64">
                    <option value="">Todos los cursos</option>
                    @foreach($courses as $c) <option value="{{ $c->id }}">{{ Str::limit($c->title, 30) }}</option> @endforeach
                </select>
            @endif
        </div>

        @if(count($selected) > 0)
            <div class="flex items-center gap-2 bg-indigo-50 px-3 py-2 rounded-md border border-indigo-100 animate-pulse">
                <span class="text-xs font-bold text-indigo-700">{{ count($selected) }} seleccionados</span>
                @if($activeTab === 'pending')
                    <button wire:click="approveSelected" class="bg-green-500 text-white px-3 py-1 rounded text-xs hover:bg-green-600 font-bold"><i class="fas fa-check mr-1"></i> Validar</button>
                @endif
                <button wire:click="$dispatch('confirm-delete-enrollments')" class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600 font-bold"><i class="fas fa-trash mr-1"></i> Eliminar</button>
            </div>
        @endif
    </div>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-gray-100">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 text-gray-500 text-xs font-semibold uppercase tracking-wider text-left">
                    <tr>
                        <th class="px-4 py-3 w-4"><input type="checkbox" wire:model.live="selectAll" class="rounded border-gray-300 text-indigo-600 shadow-sm"></th>
                        <th class="px-6 py-3">Estudiante</th>
                        <th class="px-6 py-3">Curso / Precio</th>
                        <th class="px-6 py-3">Estado</th>
                        <th class="px-6 py-3 text-right">Acciones</th> </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($enrollments as $enrollment)
                        <tr class="hover:bg-gray-50 transition-colors {{ in_array($enrollment->id, $selected) ? 'bg-indigo-50' : '' }}">
                            <td class="px-4 py-4"><input type="checkbox" wire:model.live="selected" value="{{ $enrollment->id }}" class="rounded border-gray-300 text-indigo-600 shadow-sm"></td>
                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ $enrollment->user->profile_photo_url }}" alt="">
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900">{{ $enrollment->user->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $enrollment->user->email }}</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 font-medium">{{ Str::limit($enrollment->course->title, 30) }}</div>
                                <div class="text-xs text-gray-500">Pagado: ${{ number_format($enrollment->price_paid, 2) }}</div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $colors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'active' => 'bg-green-100 text-green-800',
                                        'completed' => 'bg-blue-100 text-blue-800',
                                        'cancelled' => 'bg-red-100 text-red-800',
                                    ];
                                    $labels = [
                                        'pending' => 'Pendiente', 'active' => 'Activo', 'completed' => 'Completado', 'cancelled' => 'Cancelado'
                                    ];
                                @endphp

                                {{-- 1. EL BADGE DE ESTADO --}}
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $colors[$enrollment->status] ?? 'bg-gray-100' }}">
                                    {{ $labels[$enrollment->status] ?? $enrollment->status }}
                                </span>

                                {{-- 2. LA FECHA CORREGIDA (Aquí es donde estaba el error) --}}
                                <div class="text-[10px] text-gray-400 mt-1">
                                    {{-- Usamos ?-> para evitar el error si la fecha es null --}}
                                    {{ $enrollment->created_at?->format('d/m/Y') ?? '-' }}
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button wire:click="edit({{ $enrollment->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3" title="Editar Detalles">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button wire:click="$dispatch('confirm-delete-single', { id: {{ $enrollment->id }} })" class="text-red-500 hover:text-red-700" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">No hay registros.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">{{ $enrollments->links() }}</div>
    </div>

    <x-dialog-modal wire:model="showManualModal">
        <x-slot name="title">Matrícula Manual</x-slot>
        <x-slot name="content">
            <div class="space-y-6">

                <div class="relative">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Buscar Estudiante</label>

                    <div class="relative">
                        <input wire:model.live.debounce.300ms="userSearch" type="text"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 {{ $manualUserId ? 'bg-green-50 border-green-300 text-green-700' : '' }}"
                            placeholder="Escribe nombre o correo...">

                        @if($manualUserId)
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fas fa-check-circle text-green-500"></i>
                        </div>
                        @else
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        @endif
                    </div>
                    @error('manualUserId') <span class="text-red-500 text-xs mt-1">Debes seleccionar un estudiante de la lista.</span> @enderror

                    @if(!empty($foundUsers))
                    <div class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm">
                        @foreach($foundUsers as $user)
                        <div wire:click="selectUser({{ $user->id }}, '{{ $user->name }}')"
                            class="cursor-pointer select-none relative py-2 pl-3 pr-9 hover:bg-indigo-50 text-gray-900 border-b border-gray-100 last:border-0">
                            <div class="flex items-center">
                                <img src="{{ $user->profile_photo_url }}" class="h-6 w-6 rounded-full mr-2">
                                <span class="font-normal block truncate">
                                    {{ $user->name }} <span class="text-gray-500 text-xs">({{ $user->email }})</span>
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @elseif(strlen($userSearch) > 2 && !$manualUserId)
                    <div class="absolute z-10 mt-1 w-full bg-white shadow-lg rounded-md p-3 text-center border border-gray-200">
                        <p class="text-sm text-gray-500 mb-2">No encontrado.</p>
                        <button wire:click="$set('isCreatingUser', true)" class="text-indigo-600 text-xs font-bold hover:underline">
                            + Crear nuevo estudiante
                        </button>
                    </div>
                    @endif
                </div>

                @if($isCreatingUser)
                <div class="bg-indigo-50 p-4 rounded-lg border border-indigo-100 animate-fade-in-down">
                    <div class="flex justify-between items-center mb-3">
                        <h4 class="text-sm font-bold text-indigo-700">Nuevo Estudiante</h4>
                        <button wire:click="$set('isCreatingUser', false)" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
                    </div>

                    <div class="grid grid-cols-1 gap-3">
                        <input wire:model="newUser.name" type="text" placeholder="Nombre completo" class="text-sm rounded border-gray-300">
                        <input wire:model="newUser.email" type="email" placeholder="Correo electrónico" class="text-sm rounded border-gray-300">
                        <input wire:model="newUser.password" type="password" placeholder="Contraseña (mín 8)" class="text-sm rounded border-gray-300">
                    </div>
                    <div class="mt-3 text-right">
                        <button wire:click="createQuickUser" class="bg-indigo-600 text-white px-3 py-1.5 rounded text-xs font-bold hover:bg-indigo-700 shadow-sm">
                            Guardar y Seleccionar
                        </button>
                    </div>
                    @error('newUser.email') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>
                @endif

                <div>
                    <label class="block text-sm font-medium text-gray-700">Curso a Matricular</label>
                    <select wire:model="manualCourseId" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Seleccione un curso...</option>
                        @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                        @endforeach
                    </select>
                    @error('manualCourseId') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                @if($manualUserId && $manualCourseId)
                <div class="bg-green-50 p-3 rounded text-xs text-green-700 flex items-start">
                    <i class="fas fa-check-circle mt-0.5 mr-2"></i>
                    <div>
                        Todo listo para matricular a <strong>{{ $userSearch }}</strong>. <br>
                        Acceso inmediato sin validación de pago.
                    </div>
                </div>
                @endif
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('showManualModal', false)" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>
            <x-button class="ml-2 bg-indigo-600 hover:bg-indigo-700" wire:click="saveManualEnrollment" wire:loading.attr="disabled">
                Confirmar Matrícula
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="showEditModal">
        <x-slot name="title">Editar Matrícula</x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-1 gap-4">
                <div class="bg-gray-50 p-3 rounded text-sm text-gray-600">
                    <p><strong>Estudiante:</strong> {{ $editUser }}</p>
                    <p><strong>Curso:</strong> {{ $editCourse }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Estado</label>
                    <select wire:model="editStatus" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="pending">Pendiente de Pago</option>
                        <option value="active">Activo (Aprobado)</option>
                        <option value="completed">Completado</option>
                        <option value="cancelled">Cancelado / Rechazado</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Precio Pagado</label>
                    <input wire:model="editPrice" type="number" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Fecha de Matrícula</label>
                    <input wire:model="editDate" type="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500">
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('showEditModal', false)">Cancelar</x-secondary-button>
            <x-button class="ml-2 bg-indigo-600" wire:click="update">Guardar Cambios</x-button>
        </x-slot>
    </x-dialog-modal>

    <script>
        document.addEventListener('livewire:initialized', () => {
            // Confirmación Borrado Masivo
            Livewire.on('confirm-delete-enrollments', () => {
                Swal.fire({
                    title: '¿Eliminar seleccionados?',
                    text: "Esta acción no se puede deshacer.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) Livewire.dispatch('delete-enrollments-confirmed');
                })
            });

            // Confirmación Borrado Individual
            Livewire.on('confirm-delete-single', (data) => {
                Swal.fire({
                    title: '¿Eliminar matrícula?',
                    text: "El estudiante perderá el acceso al curso.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) Livewire.dispatch('delete-single-confirmed', { id: data.id });
                })
            });
        });
    </script>
</div>