<x-app-layout>
    <x-slot name="header">
        {{ __('Gestión de Cursos') }}
    </x-slot>

    <div class="max-w-7xl mx-auto">
        @livewire('admin.course-list')
    </div>
</x-app-layout>