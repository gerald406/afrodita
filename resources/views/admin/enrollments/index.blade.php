<x-app-layout>
    <x-slot name="header">{{ __('Control de Matrículas') }}</x-slot>
    <div class="max-w-7xl mx-auto">
        @livewire('admin.enrollment-manager')
    </div>
</x-app-layout>