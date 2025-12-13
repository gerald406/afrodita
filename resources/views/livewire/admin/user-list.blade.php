<div class="space-y-6">
    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row gap-3">
            
            <!-- Caja de búsqueda - Ocupa más espacio -->
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input wire:model.live.debounce.300ms="search" 
                       type="text"
                       class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                       placeholder="Buscar nombre o correo...">
            </div>

            <!-- Select de roles - Ancho automático -->
            <div class="sm:w-48">
                <select wire:model.live="roleFilter" 
                        class="w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Todos los Roles</option>
                    <option value="student">Estudiantes</option>
                    <option value="instructor">Instructores</option>
                    <option value="admin">Administradores</option>
                </select>
            </div>

            <!-- Botón - Ancho automático -->
            <div class="sm:w-auto">
                <a href="{{ route('admin.users.create') }}" 
                   class="inline-flex items-center justify-center w-full sm:w-auto px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none transition-colors whitespace-nowrap">
                    <i class="fas fa-user-plus mr-2"></i> 
                    Nuevo Usuario
                </a>
            </div>
        </div>
    </div>


    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-gray-100">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 text-gray-500 text-xs font-semibold uppercase tracking-wider text-left">
                    <tr>
                        <th class="px-6 py-3">Usuario</th>
                        <th class="px-6 py-3">Rol</th>
                        <th class="px-6 py-3">Fecha Registro</th>
                        <th class="px-6 py-3 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($users as $user)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ $user->profile_photo_url }}" alt="">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($user->role === 'admin')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Administrador</span>
                                @elseif($user->role === 'instructor')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Instructor</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Estudiante</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $user->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <button wire:click="$dispatch('confirm-delete', { id: {{ $user->id }} })" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                No se encontraron usuarios.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            {{ $users->links() }}
        </div>
    </div>
</div>