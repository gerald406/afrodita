<x-app-layout>
    <x-slot name="header">{{ __('Editar Curso') }}</x-slot>
    <div class="max-w-7xl mx-auto">
        @livewire('admin.course-form', ['course' => $course])
    </div>
</x-app-layout>