<x-app-layout>
    <x-slot name="header">{{ __('Gestión de Usuarios') }}</x-slot>
    <div class="max-w-7xl mx-auto">
        @livewire('admin.user-list')
    </div>
</x-app-layout>