@props(['disabled' => false])

<div
    x-data="{
        value: @entangle($attributes->wire('model')),
        editor: null,
        init() {
            // Inicializar CKEditor
            ClassicEditor.create(this.$refs.myEditor, {
                // Configuración opcional de la barra de herramientas (para mantenerlo simple)
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo' ]
            })
            .then(editor => {
                this.editor = editor;

                // Cargar el valor inicial desde Livewire
                editor.setData(this.value || '');

                // Cuando el editor cambia, actualizar la variable de Alpine/Livewire
                editor.model.document.on('change:data', () => {
                    this.value = editor.getData();
                    // Disparar evento de input para validación en tiempo real si es necesario
                    $dispatch('input', this.value);
                });

                // Observar cambios externos en Livewire (por si se resetea el formulario)
                this.$watch('value', (newValue) => {
                    if (editor.getData() !== newValue) {
                        editor.setData(newValue || '');
                    }
                });
            })
            .catch(error => {
                console.error(error);
            });
        }
    }"
    wire:ignore {{-- Importante: Evita que Livewire re-renderice este div y mate al editor --}}
    class="w-full"
>
    {{-- El textarea original se oculta pero sirve de base --}}
    <textarea 
        x-ref="myEditor" 
        style="display: none;"
        {{ $disabled ? 'disabled' : '' }}
        {!! $attributes->whereDoesntStartWith('wire:model') !!}
    ></textarea>
</div>

{{-- Estilos para ajustar CKEditor a Tailwind (opcional, para que se vea integrado) --}}
<style>
    .ck-editor__editable_inline {
        min-height: 200px; /* Altura mínima */
        max-height: 400px;
    }
    .ck-editor__editable {
        background-color: white !important;
        color: #374151 !important; /* text-gray-700 */
    }
    /* Si usas modo oscuro, necesitarás ajustes adicionales aquí */
</style>