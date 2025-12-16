<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

class CategoryManager extends Component
{
    use WithPagination;

    // Propiedades del formulario
    public $name, $slug, $color = 'indigo';
    public $categoryId; // Para saber si editamos

    // Control del Modal
    public $isOpen = false;
    public $search = '';

    // Colores disponibles para Tailwind (puedes agregar más)
    public $colors = [
        'indigo' => 'Indigo',
        'blue' => 'Azul',
        'red' => 'Rojo',
        'green' => 'Verde',
        'yellow' => 'Amarillo',
        'purple' => 'Morado',
        'pink' => 'Rosa',
        'gray' => 'Gris'
    ];

    protected $rules = [
        'name' => 'required|min:3',
        'slug' => 'required|unique:categories,slug',
        'color' => 'required'
    ];

    public function render()
    {
        // 1. Consulta con buscador
        $categories = Category::where('name', 'like', '%' . $this->search . '%')
            ->withCount('courses') // Contamos cursos asociados
            ->latest()             // Ordenamos por más reciente
            ->paginate(10);        // Paginación

        // 2. Retornamos la vista ESPECIFICANDO el layout
        return view('livewire.admin.category-manager', compact('categories'))
            ->layout('layouts.app'); // <--- ESTA LÍNEA ES LA SOLUCIÓN AL ERROR
    }

    // Generar Slug automáticamente
    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    // Abrir Modal para CREAR
    public function create()
    {
        $this->resetInputFields();
        $this->isOpen = true;
    }

    // Abrir Modal para EDITAR
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->color = $category->color;

        $this->isOpen = true;
    }

    // Guardar (Create o Update)
    public function store()
    {
        // Validación personalizada para el update (ignorar slug propio)
        $this->validate([
            'name' => 'required|min:3',
            'slug' => 'required|unique:categories,slug,' . ($this->categoryId ?? ''),
            'color' => 'required'
        ]);

        Category::updateOrCreate(['id' => $this->categoryId], [
            'name' => $this->name,
            'slug' => $this->slug,
            'color' => $this->color
        ]);

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'title' => $this->categoryId ? 'Categoría actualizada' : 'Categoría creada'
        ]);

        $this->closeModal();
        $this->resetInputFields();
    }

    // Eliminar (Escucha el evento de SweetAlert)
    #[On('delete-category')]
    public function delete($id)
    {
        $category = Category::find($id);

        if ($category) {
            // Opcional: Verificar si tiene cursos antes de borrar
            if ($category->courses()->count() > 0) {
                $this->dispatch('swal:modal', [
                    'type' => 'error',
                    'title' => 'No se puede eliminar',
                    'text' => 'Esta categoría tiene cursos asociados.'
                ]);
                return;
            }

            $category->delete();
            $this->dispatch('swal:toast', ['type' => 'info', 'title' => 'Categoría eliminada']);
        }
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->slug = '';
        $this->color = 'indigo';
        $this->categoryId = null;
        $this->resetValidation();
    }
}
