<x-app-layout>
    <x-slot name="header">{{ __('Registrar Usuario') }}</x-slot>
    <div class="max-w-7xl mx-auto">
        @livewire('admin.user-form')
    </div>
</x-app-layout>