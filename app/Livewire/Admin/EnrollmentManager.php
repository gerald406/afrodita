<?php

namespace App\Livewire\Admin;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EnrollmentManager extends Component
{
    use WithPagination;

    // --- ESTADO DE LA UI (FILTROS Y TABS) ---
    public $activeTab = 'pending'; // 'pending' | 'active'
    public $search = '';
    public $courseFilter = '';

    // --- SELECCIÓN MASIVA (CHECKBOXES) ---
    public $selected = [];
    public $selectAll = false;

    // --- MODAL DE MATRÍCULA MANUAL (BUSCADOR + CREAR) ---
    public $showManualModal = false;
    public $manualCourseId;

    // Variables para el Buscador de Usuarios
    public $manualUserId;         // ID seleccionado para matricular
    public $userSearch = '';      // Texto tipeado en el buscador
    public $foundUsers = [];      // Resultados de la búsqueda

    // Variables para "Crear Usuario Rápido"
    public $isCreatingUser = false; // Toggle para mostrar el form pequeño
    public $newUser = [
        'name' => '',
        'email' => '',
        'password' => '',
    ];

    // --- MODAL DE EDICIÓN (INDIVIDUAL) ---
    public $showEditModal = false;
    public $editingId = null;
    public $editUser = '';
    public $editCourse = '';
    public $editStatus;
    public $editPrice;
    public $editDate;

    // =================================================================
    //  LISTENERS Y RESETEOS
    // =================================================================

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingCourseFilter()
    {
        $this->resetPage();
    }

    public function updatingActiveTab()
    {
        $this->resetPage();
        $this->selected = [];
        $this->selectAll = false;
    }

    public function updatedSelectAll($value)
    {
        $this->selected = $value
            ? $this->getQuery()->pluck('id')->map(fn($id) => (string) $id)->toArray()
            : [];
    }

    // =================================================================
    //  LÓGICA DEL BUSCADOR DE USUARIOS (EN VIVO)
    // =================================================================

    public function updatedUserSearch()
    {
        // Solo buscar si hay más de 2 caracteres
        if (strlen($this->userSearch) > 2) {
            $this->foundUsers = User::where('role', 'student')
                ->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->userSearch . '%')
                        ->orWhere('email', 'like', '%' . $this->userSearch . '%');
                })
                ->take(5)
                ->get();
        } else {
            $this->foundUsers = [];
        }
    }

    public function selectUser($id, $name)
    {
        $this->manualUserId = $id;
        $this->userSearch = $name; // Poner el nombre en el input visualmente
        $this->foundUsers = [];    // Ocultar dropdown
    }

    // =================================================================
    //  LÓGICA PARA CREAR USUARIO RÁPIDO
    // =================================================================

    public function createQuickUser()
    {
        $this->validate([
            'newUser.name' => 'required|min:3',
            'newUser.email' => 'required|email|unique:users,email',
            'newUser.password' => 'required|min:8',
        ]);

        // Crear usuario
        $user = User::create([
            'name' => $this->newUser['name'],
            'email' => $this->newUser['email'],
            'password' => Hash::make($this->newUser['password']),
            'role' => 'student',
        ]);

        // Auto-seleccionar al nuevo usuario para matricularlo inmediatamente
        $this->selectUser($user->id, $user->name);

        // Resetear form y cerrar sección de creación
        $this->isCreatingUser = false;
        $this->newUser = ['name' => '', 'email' => '', 'password' => ''];

        $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Usuario creado y seleccionado']);
    }

    // =================================================================
    //  GUARDAR MATRÍCULA MANUAL
    // =================================================================

    public function saveManualEnrollment()
    {
        $this->validate([
            'manualUserId' => 'required|exists:users,id',
            'manualCourseId' => 'required|exists:courses,id',
        ]);

        // Verificar si ya existe matrícula para evitar duplicados
        $exists = Enrollment::where('user_id', $this->manualUserId)
            ->where('course_id', $this->manualCourseId)->exists();

        if ($exists) {
            $this->dispatch('swal:toast', ['type' => 'error', 'title' => 'El usuario ya está inscrito en este curso']);
            return;
        }

        Enrollment::create([
            'user_id' => $this->manualUserId,
            'course_id' => $this->manualCourseId,
            'status' => 'active', // Al ser manual, nace activo
            'enrolled_at' => now(),
            'price_paid' => 0.00,
        ]);

        $this->showManualModal = false;

        // Resetear todo el modal
        $this->reset(['manualUserId', 'manualCourseId', 'userSearch', 'foundUsers', 'isCreatingUser']);
        $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Matrícula exitosa']);
    }

    // =================================================================
    //  ACCIONES MASIVAS
    // =================================================================

    public function approveSelected()
    {
        if (empty($this->selected)) return;

        Enrollment::whereIn('id', $this->selected)->update([
            'status' => 'active',
            'enrolled_at' => now()
        ]);

        $this->dispatch('swal:toast', ['type' => 'success', 'title' => count($this->selected) . ' Validados']);
        $this->resetSelection();
    }

    #[On('delete-enrollments-confirmed')]
    public function deleteSelected()
    {
        if (empty($this->selected)) return;

        Enrollment::whereIn('id', $this->selected)->delete();

        $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Registros eliminados']);
        $this->resetSelection();
    }

    public function resetSelection()
    {
        $this->selected = [];
        $this->selectAll = false;
    }

    // =================================================================
    //  ACCIONES INDIVIDUALES (EDITAR / ELIMINAR)
    // =================================================================

    public function edit($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $this->editingId = $id;
        $this->editUser = $enrollment->user->name;
        $this->editCourse = $enrollment->course->title;
        $this->editStatus = $enrollment->status;
        $this->editPrice = $enrollment->price_paid;
        // Usamos safe navigation operator para evitar error si fecha es null
        $this->editDate = $enrollment->enrolled_at?->format('Y-m-d');

        $this->showEditModal = true;
    }

    public function update()
    {
        $this->validate([
            'editStatus' => 'required|in:pending,active,completed,cancelled',
            'editPrice' => 'required|numeric|min:0',
            'editDate' => 'required|date',
        ]);

        $enrollment = Enrollment::findOrFail($this->editingId);
        $enrollment->update([
            'status' => $this->editStatus,
            'price_paid' => $this->editPrice,
            'enrolled_at' => $this->editDate,
        ]);

        $this->showEditModal = false;
        $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Cambios guardados']);
    }

    #[On('delete-single-confirmed')]
    public function deleteSingle($id)
    {
        Enrollment::find($id)?->delete();
        $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Matrícula eliminada']);
    }

    // =================================================================
    //  CONSULTAS Y RENDER
    // =================================================================

    private function getQuery()
    {
        return Enrollment::with(['user', 'course'])
            ->when($this->activeTab === 'pending', fn($q) => $q->where('status', 'pending'))
            ->when($this->activeTab === 'active', function ($q) {
                $q->whereIn('status', ['active', 'completed', 'cancelled']);
                if ($this->courseFilter) $q->where('course_id', $this->courseFilter);
            })
            ->when(
                $this->search,
                fn($q) =>
                $q->whereHas('user', fn($u) => $u->where('name', 'like', "%{$this->search}%")->orWhere('email', 'like', "%{$this->search}%"))
            )
            ->latest('enrolled_at');
    }

    public function render()
    {
        $enrollments = $this->getQuery()->paginate(10);

        // Listamos cursos para el select
        $courses = Course::orderBy('title')->get(['id', 'title']);

        // Ya no enviamos $students porque usamos el buscador dinámico
        return view('livewire.admin.enrollment-manager', compact('enrollments', 'courses'));
    }
}
