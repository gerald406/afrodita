<?php

namespace App\Livewire\Web;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url; // Importante para Livewire 3
use App\Models\Course;
use App\Models\Category;

class CourseCatalog extends Component
{
    use WithPagination;

    // Propiedades públicas sincronizadas con la URL
    #[Url(except: '')]
    public $search = '';

    #[Url(except: 'newest')]
    public $sort = 'newest';

    #[Url(except: '')]
    public $category = ''; // ID o Slug de la categoría

    // Resetear paginación al cambiar filtros
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function updatedSort()
    {
        $this->resetPage();
    }
    public function updatedCategory()
    {
        $this->resetPage();
    }

    // Método para limpiar todo desde el botón de "No resultados"
    public function resetFilters()
    {
        $this->reset(['search', 'category', 'sort']);
        $this->resetPage();
    }

    public function render()
    {
        // 1. Categorías para el sidebar (solo las que tienen cursos publicados)
        $categories = Category::whereHas('courses', function ($q) {
            $q->where('status', 'published');
        })->withCount(['courses' => function ($q) {
            $q->where('status', 'published');
        }])->get();

        // 2. Query Principal
        $coursesQuery = Course::query()
            ->where('status', 'published')
            ->with(['teacher', 'category']); // Eager loading

        // Filtro: Buscador
        if ($this->search) {
            $coursesQuery->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%')
                    ->orWhereHas('teacher', function ($t) {
                        $t->where('name', 'like', '%' . $this->search . '%');
                    });
            });
        }

        // Filtro: Categoría (por ID o Slug, asumimos ID por tu código anterior)
        if ($this->category) {
            $coursesQuery->where('category_id', $this->category);
        }

        // Ordenamiento
        switch ($this->sort) {
            case 'price_asc':
                $coursesQuery->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $coursesQuery->orderBy('price', 'desc');
                break;
            case 'popular':
                $coursesQuery->withCount('students')->orderBy('students_count', 'desc');
                break;
            default: // newest
                $coursesQuery->latest();
                break;
        }

        $courses = $coursesQuery->paginate(9);

        return view('livewire.web.course-catalog', [
            'courses' => $courses,
            'categories' => $categories
        ])->layout('layouts.web');
    }
}
