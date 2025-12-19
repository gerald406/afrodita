<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-gray-100">
        
        <div class="flex h-screen overflow-hidden" 
            x-data="{ 
                sidebarOpen: false, 
                sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true',
                toggleCollapse() {
                    this.sidebarCollapsed = !this.sidebarCollapsed;
                    localStorage.setItem('sidebarCollapsed', this.sidebarCollapsed);
                }
            }">
            
            <x-sidebar />

            <div x-show="sidebarOpen" class="fixed inset-0 flex z-40 md:hidden" role="dialog" aria-modal="true" style="display: none;">
                <div class="fixed inset-0 bg-gray-600 bg-opacity-75" @click="sidebarOpen = false"></div>
                <div class="relative flex-1 flex flex-col max-w-xs w-full bg-white">
                    <div class="absolute top-0 right-0 -mr-12 pt-2">
                        <button @click="sidebarOpen = false" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                            <span class="sr-only">Cerrar sidebar</span>
                            <i class="fas fa-times text-white text-xl"></i>
                        </button>
                    </div>
                    <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                        <div class="flex-shrink-0 flex items-center px-4">
                            <span class="font-bold text-xl text-gray-900">MENÚ</span>
                        </div>
                        </div>
                </div>
            </div>

            <div class="flex-1 flex flex-col min-w-0 overflow-hidden transition-all duration-300">
                
                <header class="bg-white shadow-sm z-10">
                    <div class="px-4 sm:px-6 lg:px-8">
                        <div class="flex justify-between h-16">
                            <div class="flex items-center">
                                <button @click="sidebarOpen = true" type="button" class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden">
                                    <span class="sr-only">Abrir sidebar</span>
                                    <i class="fas fa-bars text-xl"></i>
                                </button>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="ml-3 relative">
                                    <x-dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                            </button>
                                        </x-slot>
                                        <x-slot name="content">
                                            <x-dropdown-link href="{{ route('profile.show') }}">{{ __('Perfil') }}</x-dropdown-link>
                                            <form method="POST" action="{{ route('logout') }}" x-data>
                                                @csrf
                                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">{{ __('Cerrar Sesión') }}</x-dropdown-link>
                                            </form>
                                        </x-slot>
                                    </x-dropdown>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <main class="flex-1 overflow-y-auto bg-gray-100 p-6">
                    @if (isset($header))
                        <header class="mb-6">
                            <h1 class="text-2xl font-bold text-gray-900">{{ $header }}</h1>
                        </header>
                    @endif
                    {{ $slot }}
                </main>
            </div>
        </div>

        @stack('modals')
        @livewireScripts
        @stack('scripts')
        <script>
            // Esperar a que el DOM esté cargado
            document.addEventListener('DOMContentLoaded', function() {
                
                // Verificar que Livewire esté disponible antes de usarlo
                const initLivewire = () => {
                    if (typeof Livewire === 'undefined') {
                        console.warn('Livewire no está disponible en esta página');
                        return;
                    }

                    // 1. Escuchar evento de Notificación (Toast)
                    Livewire.on('swal:toast', (event) => {
                        const data = event[0] || event;
                        
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        
                        Toast.fire({
                            icon: data.type || 'info',
                            title: data.title || 'Notificación',
                            text: data.text || ''
                        });
                    });

                    // 2. Escuchar evento de Confirmación de Borrado
                    Livewire.on('confirm-delete', (event) => {
                        const data = event[0] || event;
                        
                        Swal.fire({
                            title: '¿Estás seguro?',
                            text: "No podrás revertir esto.",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Sí, eliminar',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Livewire.dispatch('delete-confirmed', { 
                                    id: data.id || data[0]?.id 
                                });
                            }
                        });
                    });
                };

                // Intentar inicializar después de un pequeño delay
                setTimeout(initLivewire, 100);
            });

            // Función global para confirmación de eliminación (formularios tradicionales)
            window.confirmDelete = function(id, type, method) {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "No podrás revertir esto.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (typeof Livewire !== 'undefined') {
                            Livewire.dispatch('delete-confirmed', { id: id, method: method });
                        } else {
                            // Para formularios tradicionales
                            const form = document.getElementById('delete-form-' + id);
                            if (form) form.submit();
                        }
                    }
                });
            }
        </script>
    </body>
</html>