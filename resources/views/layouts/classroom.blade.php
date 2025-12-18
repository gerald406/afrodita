<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Aula Virtual</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-slate-900 text-white">
        
        {{ $slot }}

        @livewireScripts
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <script>
            // Listener global para notificaciones Toast
            document.addEventListener('livewire:initialized', () => {
                Livewire.on('swal:toast', (event) => {
                    // Accedemos al primer elemento del array de eventos
                    const data = event[0]; 
                    
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        background: '#1e293b', // Fondo oscuro (Slate-800)
                        color: '#fff'          // Texto blanco
                    });

                    Toast.fire({
                        icon: data.type,
                        title: data.title,
                        text: data.text || ''
                    });
                });

                Livewire.on('swal:modal', (event) => {
                    const data = event[0];
                    Swal.fire({
                        title: data.title,
                        text: data.text,
                        icon: data.type,
                        background: '#1e293b',
                        color: '#fff',
                        confirmButtonColor: '#4f46e5' // Indigo-600
                    });
                });
            });
        </script>
    </body>
</html>