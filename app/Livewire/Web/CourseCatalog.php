<?php

namespace App\Livewire\Web;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Course;
use App\Models\Category;

class CourseCatalog extends Component
{
    use WithPagination;

    // Propiedades públicas (se sincronizan con la URL)
    public $search = '';
    public $sort = 'newest';
    public $category = ''; // Slug de la categoría seleccionada

    // Modificar la URL para que sea compartible (ej: ?search=laravel&sort=price_asc)
    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
        'sort' => ['except' => 'newest'],
    ];

    // Resetear paginación cuando se busca o filtra
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingSort()
    {
        $this->resetPage();
    }
    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function render()
    {
        // 1. Obtener Categorías con conteo de cursos activos
        $categories = Category::withCount(['courses' => function ($q) {
            $q->where('status', 'published');
        }])->get();

        // 2. Query Principal de Cursos
        $coursesQuery = Course::query()
            ->where('status', 'published')
            ->with(['teacher', 'category']); // Eager loading

        // Filtro: Buscador
        if ($this->search) {
            $coursesQuery->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        // Filtro: Categoría
        if ($this->category) {
            $coursesQuery->whereHas('category', function ($q) {
                $q->where('slug', $this->category);
            });
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
        ]);
    }
}
