<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Course;
use App\Models\CourseSection;
use App\Models\Lesson;
use App\Models\LessonResource; // Modelo para adjuntos
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Livewire\Attributes\On; // Atributo para escuchar eventos JS

class CourseForm extends Component
{
    use WithFileUploads;

    public $course; // Instancia del curso (si estamos editando)

    // --- 1. CAMPOS DE INFORMACIÓN BÁSICA DEL CURSO ---
    public $title;
    public $slug;
    public $description;
    public $price;
    public $compare_price;
    public $status = 'draft';
    public $image;      // Ruta de la imagen actual (string)
    public $newImage;   // Archivo temporal para nueva subida (Livewire Upload)

    // --- 2. CONTROL DE INTERFAZ (TABS) ---
    public $activeTab = 'info'; // 'info' = Info Básica, 'curriculum' = Constructor

    // --- 3. VARIABLES PARA SECCIONES ---
    public $sectionTitle;

    // --- 4. VARIABLES PARA LECCIONES ---
    public $lessonId = null; // Si tiene valor, estamos editando una lección existente
    public $currentSectionId; // ID de la sección donde se está trabajando

    public $lessonTitle;
    public $lessonVideoSource; // Input único que acepta URL o <iframe...>
    public $lessonDuration;    // Minutos
    public $lessonIsFree = false;

    // --- 5. VARIABLES PARA RECURSOS (MATERIAL ADJUNTO) ---
    public $resourceTitle;
    public $resourceType = 'pdf'; // pdf, link, zip, image
    public $resourceFile; // Archivo temporal
    public $resourceUrl;  // URL externa

    public $user_id; // Variable para el profesor seleccionado
    public $teachers = []; // Lista de profesores

    // --- NUEVAS PROPIEDADES ---
    public $category_id;
    public $categories = [];

    // Reglas de validación base
    protected $rules = [
        'title' => 'required|min:5',
        'slug'  => 'required|unique:courses,slug',
        'price' => 'required|numeric|min:0',
        'status' => 'required|in:draft,published,archived',
    ];

    /**
     * Inicialización del componente
     */
    public function mount($course = null)
    {
        // Cargamos solo usuarios con rol instructor
        $this->teachers = User::where('role', 'instructor')->orWhere('role', 'admin')->get();

        $this->categories = Category::all();

        if ($course) {
            $this->course = $course;
            $this->title = $course->title;
            $this->slug = $course->slug;
            $this->description = $course->description;
            $this->price = $course->price;
            $this->compare_price = $course->compare_price;
            $this->status = $course->status;

            $this->category_id = $course->category_id;

            $this->image = $course->image_path;
            $this->user_id = $course->user_id;
        } else {
            $this->price = 0.00; // Valor por defecto
            $this->user_id = auth()->id();
        }
    }

    /**
     * Generar Slug automáticamente al escribir el título (solo al crear)
     */
    public function updatedTitle($value)
    {
        if (!$this->course) {
            $this->slug = Str::slug($value);
        }
    }

    // =================================================================
    //  MÉTODOS GLOBALES Y UTILIDADES
    // =================================================================

    /**
     * Listener para borrar registros tras confirmación de SweetAlert
     * JS dispara 'trigger-delete' con {id: 1, method: 'deleteSection'}
     */
    #[On('trigger-delete')]
    public function confirmedDelete($data)
    {
        $id = $data['id'];
        $method = $data['method'];

        // Verificamos que el método exista en esta clase por seguridad
        if (method_exists($this, $method)) {
            $this->$method($id);
        }
    }

    /**
     * Helper para disparar notificación "Toast"
     */
    public function notify($title, $type = 'success', $text = '')
    {
        $this->dispatch('swal:toast', [
            'title' => $title,
            'type'  => $type,
            'text'  => $text
        ]);
    }

    // =================================================================
    //  LÓGICA DEL CURSO (INFO BÁSICA)
    // =================================================================

    public function saveInfo()
    {
        // Validación personalizada para ignorar el slug propio al editar
        $this->validate([
            'title' => 'required|min:5',
            'slug'  => [
                'required',
                'alpha_dash', // Solo letras, números, guiones y guiones bajos
                'unique:courses,slug,' . ($this->course->id ?? '')
            ],
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'newImage' => 'nullable|image|max:2048', // 2MB Max
            'user_id' => 'required|exists:users,id',
        ]);

        $data = [
            'user_id' => $this->user_id, // Usamos la selección del select
            'category_id' => $this->category_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'compare_price' => $this->compare_price,
            'status' => $this->status,
        ];

        // Procesar imagen si se subió una nueva
        if ($this->newImage) {
            $path = $this->newImage->store('courses', 'public');
            $data['image_path'] = '/storage/' . $path;
        }

        if ($this->course) {
            // Actualizar
            $this->course->update($data);
            $this->notify('Curso actualizado correctamente');
        } else {
            // Crear
            $this->course = Course::create($data);
            $this->notify('Curso creado con éxito. Ahora agrega el contenido.', 'success');

            // Redirigir a la vista de edición para habilitar la pestaña Curriculum
            return redirect()->route('admin.courses.edit', $this->course);
        }
    }

    // =================================================================
    //  LÓGICA DE SECCIONES (MÓDULOS)
    // =================================================================

    public function addSection()
    {
        $this->validate(['sectionTitle' => 'required|min:3']);

        $this->course->sections()->create([
            'title' => $this->sectionTitle,
            'sort_order' => $this->course->sections()->count() + 1
        ]);

        $this->reset('sectionTitle');
        $this->course->refresh(); // Recargar relaciones
        $this->notify('Módulo agregado');
    }

    public function deleteSection($id)
    {
        $section = CourseSection::find($id);
        // Verificar que la sección pertenece al curso actual
        if ($section && $section->course_id === $this->course->id) {
            $section->delete();
            $this->course->refresh();
            $this->notify('Módulo eliminado', 'info');
        } else {
            $this->notify('Sección no encontrada o no autorizada', 'error');
        }
    }

    // =================================================================
    //  LÓGICA DE LECCIONES (VIDEOS + CONTENIDO)
    // =================================================================

    /**
     * Preparar formulario para CREAR nueva lección en una sección
     */
    public function createLesson($sectionId)
    {
        $this->resetLessonForm();
        $this->currentSectionId = $sectionId;
    }

    /**
     * Preparar formulario para EDITAR una lección existente
     */
    public function editLesson($lessonId)
    {
        $lesson = Lesson::find($lessonId);

        $this->lessonId = $lesson->id;
        $this->currentSectionId = $lesson->course_section_id;

        // Cargar datos al formulario
        $this->lessonTitle = $lesson->title;
        $this->lessonDuration = $lesson->duration_minutes;
        $this->lessonIsFree = $lesson->is_free;

        // Determinar qué mostrar en el input: el iframe o la URL
        if (!empty($lesson->video_iframe)) {
            $this->lessonVideoSource = $lesson->video_iframe;
        } else {
            $this->lessonVideoSource = $lesson->video_url;
        }
    }

    /**
     * Guardar Lección (Create o Update)
     */
    public function saveLesson()
    {
        $this->validate([
            'lessonTitle' => 'required|min:3',
            'lessonVideoSource' => 'required',
            'lessonDuration' => 'required|numeric|min:1',
        ]);

        // Lógica inteligente: ¿Es Iframe o URL?
        $videoUrl = null;
        $videoIframe = null;

        // Si empieza con <iframe, asumimos que es código embebido
        if (Str::startsWith(trim($this->lessonVideoSource), '<iframe')) {
            // Validar que el iframe sea de dominios confiables
            $allowedDomains = ['youtube.com', 'youtu.be', 'vimeo.com', 'wistia.com', 'wistia.net'];
            $isValid = false;

            foreach ($allowedDomains as $domain) {
                if (Str::contains($this->lessonVideoSource, $domain)) {
                    $isValid = true;
                    break;
                }
            }

            if (!$isValid) {
                $this->addError('lessonVideoSource', 'Solo se permiten videos de YouTube, Vimeo o Wistia.');
                return;
            }

            // SEGURIDAD: Extraer solo la URL y reconstruir el iframe limpio
            // para prevenir XSS mediante atributos maliciosos (ej: onload="alert('XSS')")
            if (preg_match('/src=["\']([^"\']+)["\']/', $this->lessonVideoSource, $matches)) {
                $srcUrl = $matches[1];

                // Validar nuevamente que la URL extraída sea de dominios confiables
                $isValidUrl = false;
                foreach ($allowedDomains as $domain) {
                    if (str_contains($srcUrl, $domain)) {
                        $isValidUrl = true;
                        break;
                    }
                }

                if (!$isValidUrl) {
                    $this->addError('lessonVideoSource', 'La URL del video no es de un dominio permitido.');
                    return;
                }

                // Reconstruir iframe limpio sin atributos maliciosos
                $videoIframe = '<iframe src="' . htmlspecialchars($srcUrl, ENT_QUOTES, 'UTF-8') . '" frameborder="0" allowfullscreen></iframe>';
            } else {
                $this->addError('lessonVideoSource', 'No se pudo extraer la URL del iframe.');
                return;
            }
        } else {
            // Validar que sea una URL válida
            $videoUrl = filter_var($this->lessonVideoSource, FILTER_VALIDATE_URL);
            if (!$videoUrl) {
                $this->addError('lessonVideoSource', 'La URL proporcionada no es válida.');
                return;
            }
        }

        $data = [
            'title' => $this->lessonTitle,
            'slug' => Str::slug($this->lessonTitle),
            'duration_minutes' => $this->lessonDuration,
            'is_free' => $this->lessonIsFree,
            'video_url' => $videoUrl,
            'video_iframe' => $videoIframe,
        ];

        if ($this->lessonId) {
            // Actualizar
            $lesson = Lesson::find($this->lessonId);
            $lesson->update($data);
            $this->notify('Lección actualizada');
        } else {
            // Crear nueva
            $data['course_section_id'] = $this->currentSectionId;
            // Calcular orden (último + 1)
            $data['sort_order'] = Lesson::where('course_section_id', $this->currentSectionId)->count() + 1;

            Lesson::create($data);
            $this->notify('Lección creada');
        }

        $this->resetLessonForm();
        $this->course->refresh();
    }

    public function deleteLesson($id)
    {
        $lesson = Lesson::find($id);
        // Verificar que la lección pertenece a una sección del curso actual
        if ($lesson && $lesson->courseSection && $lesson->courseSection->course_id === $this->course->id) {
            $lesson->delete();
            $this->course->refresh();
            $this->notify('Lección eliminada', 'info');
        } else {
            $this->notify('Lección no encontrada o no autorizada', 'error');
        }
    }

    public function resetLessonForm()
    {
        $this->reset(['lessonTitle', 'lessonVideoSource', 'lessonDuration', 'lessonIsFree', 'lessonId', 'currentSectionId']);
        // También reseteamos el formulario de recursos
        $this->reset(['resourceTitle', 'resourceType', 'resourceFile', 'resourceUrl']);
    }

    // =================================================================
    //  LÓGICA DE RECURSOS (ARCHIVOS ADJUNTOS)
    // =================================================================

    public function addResource()
    {
        // 1. Validar inputs según el tipo elegido con validación estricta de extensiones
        $this->validate([
            'resourceTitle' => 'required|min:3',
            'resourceType' => 'required|in:pdf,link,zip,image',
            // Validación estricta según tipo
            'resourceFile' => $this->resourceType !== 'link' ? $this->getFileValidationRules() : 'nullable',
            // Si es link, la URL es obligatoria
            'resourceUrl' => $this->resourceType === 'link' ? 'required|url' : 'nullable',
        ]);

        $pathOrUrl = null;

        // 2. Procesar el archivo o link
        if ($this->resourceType === 'link') {
            $pathOrUrl = $this->resourceUrl;
        } else {
            // Guardar archivo en disco 'public', carpeta 'resources'
            $path = $this->resourceFile->store('resources', 'public');
            // Guardamos con prefijo /storage/ para acceso público directo
            $pathOrUrl = '/storage/' . $path;
        }

        // 3. Guardar en Base de Datos
        LessonResource::create([
            'lesson_id' => $this->lessonId, // Se asocia a la lección que estamos editando
            'title' => $this->resourceTitle,
            'type' => $this->resourceType,
            'path_or_url' => $pathOrUrl
        ]);

        // 4. Limpiar y notificar
        $this->reset(['resourceTitle', 'resourceType', 'resourceFile', 'resourceUrl']);
        $this->notify('Recurso adjuntado correctamente');
    }

    public function deleteResource($id)
    {
        $resource = LessonResource::find($id);
        if ($resource) {
            // Opcional: Podrías borrar el archivo físico del disco aquí si no es link
            $resource->delete();
            $this->notify('Recurso eliminado', 'info');
        }
    }

    /**
     * Obtener reglas de validación de archivo según el tipo
     */
    private function getFileValidationRules()
    {
        $baseRules = 'required|file|max:10240'; // Max 10MB

        switch ($this->resourceType) {
            case 'pdf':
                return $baseRules . '|mimes:pdf';
            case 'zip':
                return $baseRules . '|mimes:zip,rar,7z';
            case 'image':
                return $baseRules . '|mimes:jpg,jpeg,png,gif,webp,svg';
            default:
                return $baseRules;
        }
    }

    public function render()
    {
        return view('livewire.admin.course-form');
    }
}
