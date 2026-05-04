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

        {{-- 
            x-data raíz:
            • sidebarOpen      → controla el drawer en móvil
            • sidebarCollapsed → controla el colapso en desktop (persiste en localStorage)
        --}}
        <div class="flex h-screen overflow-hidden"
             x-data="{
                 sidebarOpen: false,
                 sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true',
                 toggleCollapse() {
                     this.sidebarCollapsed = !this.sidebarCollapsed;
                     localStorage.setItem('sidebarCollapsed', this.sidebarCollapsed);
                 }
             }">

            {{-- 
                Sidebar único — gestiona tanto móvil (drawer fixed)
                como desktop (sticky colapsable).
                El backdrop y la lógica de apertura viven dentro del componente.
            --}}
            <x-sidebar />

            {{-- ── Área principal ── --}}
            <div class="flex-1 flex flex-col min-w-0 overflow-hidden transition-all duration-300">

                {{-- Header --}}
                <header class="bg-white shadow-sm z-10">
                    <div class="px-4 sm:px-6 lg:px-8">
                        <div class="flex justify-between h-16">

                            <div class="flex items-center">
                                {{-- Botón hamburguesa — solo visible en móvil --}}
                                <button @click="sidebarOpen = true"
                                        type="button"
                                        class="px-4 border-r border-gray-200 text-gray-500
                                               focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500
                                               md:hidden">
                                    <span class="sr-only">Abrir sidebar</span>
                                    <i class="fas fa-bars text-xl"></i>
                                </button>
                            </div>

                            <div class="flex items-center">
                                <div class="ml-3 relative">
                                    <x-dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                                <img class="h-8 w-8 rounded-full object-cover"
                                                     src="{{ Auth::user()->profile_photo_url }}"
                                                     alt="{{ Auth::user()->name }}" />
                                            </button>
                                        </x-slot>
                                        <x-slot name="content">
                                            <x-dropdown-link href="{{ route('profile.show') }}">
                                                {{ __('Perfil') }}
                                            </x-dropdown-link>
                                            <form method="POST" action="{{ route('logout') }}" x-data>
                                                @csrf
                                                <x-dropdown-link href="{{ route('logout') }}"
                                                                 @click.prevent="$root.submit();">
                                                    {{ __('Cerrar Sesión') }}
                                                </x-dropdown-link>
                                            </form>
                                        </x-slot>
                                    </x-dropdown>
                                </div>
                            </div>

                        </div>
                    </div>
                </header>

                {{-- Contenido de página --}}
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
        <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
        @stack('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {

                const initLivewire = () => {
                    if (typeof Livewire === 'undefined') {
                        console.warn('Livewire no está disponible en esta página');
                        return;
                    }

                    // 1. Toast de notificación
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

                    // 2. Confirmación de borrado
                    Livewire.on('confirm-delete', (event) => {
                        const data = event[0] || event;
                        Swal.fire({
                            title: '¿Estás seguro?',
                            text: 'No podrás revertir esto.',
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

                setTimeout(initLivewire, 100);
            });

            // Confirmación de eliminación para formularios tradicionales
            window.confirmDelete = function (id, type, method) {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'No podrás revertir esto.',
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
                            const form = document.getElementById('delete-form-' + id);
                            if (form) form.submit();
                        }
                    }
                });
            };
        </script>
    </body>
</html>