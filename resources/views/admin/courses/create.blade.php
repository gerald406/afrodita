<x-app-layout>
    <x-slot name="header">{{ __('Crear Nuevo Curso') }}</x-slot>
    <div class="max-w-7xl mx-auto">
        @livewire('admin.course-form')
    </div>
</x-app-layout>