# Informe de Auditoría de Seguridad y Flujo de Trabajo - LMS Laravel 12

**Fecha:** 13 de abril de 2026  
**Auditor:** Senior Laravel Developer  
**Estado del Sistema:** Crítico (Se requiere acción inmediata en varios módulos)

---

## 1. Hallazgos Críticos de Seguridad

### 1.1 Exposición de Respuestas Correctas (Information Leakage)
**Ubicación:** `app\Livewire\Student\QuizRunner.php` y `app\Models\QuestionAnswer.php`  
**Descripción:** El componente `QuizRunner` carga todas las preguntas y respuestas mediante `$quiz->questions()->with('answers')->get()`. Debido a que el modelo `QuestionAnswer` no oculta el campo `is_correct` en su propiedad `$hidden`, **la respuesta correcta de cada pregunta se envía al navegador del estudiante** en la carga inicial de Livewire.  
**Impacto:** Cualquier estudiante con conocimientos básicos de inspección de red (F12) puede obtener el 100% de la calificación sin conocimientos previos.

### 1.2 Escalada de Privilegios Potencial (Mass Assignment)
**Ubicación:** `app\Models\User.php`  
**Descripción:** El campo `role` se encuentra dentro de la propiedad `$fillable`.  
**Riesgo:** Si bien las acciones de Fortify filtran los campos manualmente, cualquier nuevo controlador o componente que utilice `User::create($request->all())` o `$user->update($request->all())` permitirá que un usuario se asigne a sí mismo el rol de `admin`.

### 1.3 Vulnerabilidad de Manipulación de IDs (Insecure Direct Object Reference - IDOR)
**Ubicación:** `app\Livewire\Admin\QuizBuilder.php`  
**Descripción:** El método `deleteQuestion($id)` ejecuta `Question::find($id)->delete()` sin verificar si la pregunta pertenece al `Quiz` que el administrador tiene cargado.  
**Riesgo:** Un usuario malintencionado con acceso al panel (o interceptando la petición Livewire) podría eliminar cualquier pregunta del sistema si conoce o adivina su ID numérico.

---

## 2. Errores de Flujo y Autorización (Broken Access Control)

### 2.1 Falta de Autorización Granular en Livewire
**Componentes Afectados:** `CategoryManager`, `QuizList`, `QuizBuilder`, `QuizGrades`.  
**Descripción:** Estos componentes administrativos confían únicamente en el middleware de la ruta (`role:admin`). Livewire recomienda encarecidamente realizar una autorización explícita dentro del método `mount()` y en los métodos de acción (`store`, `delete`), ya que las peticiones posteriores a Livewire podrían ser manipuladas si el middleware de ruta no está configurado globalmente de forma estricta.

### 2.2 Acceso no Autorizado a Exámenes
**Ubicación:** `app\Livewire\Student\QuizRunner.php`  
**Descripción:** El método `mount(Quiz $quiz)` no verifica si el estudiante está realmente matriculado en el curso al que pertenece el examen.  
**Riesgo:** Un estudiante matriculado en el "Curso A" puede acceder y realizar el examen del "Curso B" simplemente cambiando el ID en la URL.

---

## 3. Recomendaciones Técnicas (Estándares Laravel 12)

### 3.1 Seguridad de Datos
- **Modelo QuestionAnswer:** Añadir `protected $hidden = ['is_correct'];` para evitar la fuga de datos. La validación de la respuesta debe ocurrir exclusivamente en el servidor durante el `submitQuiz`.
- **Modelo User:** Eliminar `role` de `$fillable` y manejar los cambios de rol mediante métodos específicos protegidos por políticas de super-administrador.

### 3.2 Autorización Reforzada
- Implementar `$this->authorize('view', $quiz);` en el `mount()` de `QuizRunner`.
- En componentes administrativos, usar el trait `AuthorizesRequests` y validar cada acción:
  ```php
  public function deleteQuestion($id) {
      $question = $this->quiz->questions()->findOrFail($id); // Fuerza la pertenencia al quiz
      $question->delete();
  }
  ```

### 3.3 Optimización de Código
- **CourseLearn.php:** Se recomienda sustituir la lógica manual de `authorizeAccess()` por el uso nativo de `CoursePolicy` mediante `$this->authorize('view', $this->course);`.

---
**Conclusión:** El sistema es funcional pero presenta vulnerabilidades estructurales graves en la gestión de permisos y privacidad de datos. Se recomienda aplicar los parches mencionados antes de pasar a producción.
