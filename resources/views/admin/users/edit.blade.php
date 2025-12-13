<x-app-layout>
    <x-slot name="header">{{ __('Editar Usuario') }}</x-slot>
    <div class="max-w-7xl mx-auto">
        @livewire('admin.user-form', ['user' => $user])
    </div>
</x-app-layout>