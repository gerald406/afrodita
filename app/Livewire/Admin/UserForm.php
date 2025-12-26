<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserForm extends Component
{
    public $user;
    public $name, $email, $role = 'student', $password, $bio;
    public $dni, $phone;

    public function mount($user = null)
    {
        if ($user) {
            $this->user = $user;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->role = $user->role;
            $this->bio = $user->bio;
            $this->dni = $user->dni;
            $this->phone = $user->phone;
        }
    }

    public function save()
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user->id ?? null)],
            'role' => 'required|in:admin,instructor,student',
            'bio' => 'nullable|string|max:1000',
            'dni' => ['nullable', 'numeric', 'digits_between:8,12', Rule::unique('users')->ignore($this->user->id ?? null)],
            'phone' => 'nullable|numeric|digits_between:9,15',
        ];

        // Contraseña obligatoria solo al crear
        if (!$this->user) {
            $rules['password'] = 'required|min:8';
        } else {
            $rules['password'] = 'nullable|min:8';
        }

        $this->validate($rules);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'bio' => $this->bio,
            'dni' => $this->dni,
            'phone' => $this->phone,
        ];

        // Solo actualizar password si se escribió algo
        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->user) {
            $this->user->update($data);
            \Log::info('Usuario actualizado', [
                'user_id' => $this->user->id,
                'by' => auth()->id()
            ]);
            $message = 'Usuario actualizado correctamente';
        } else {
            $newUser = User::create($data);
            \Log::info('Usuario creado', [
                'user_id' => $newUser->id,
                'role' => $newUser->role,
                'by' => auth()->id()
            ]);
            $message = 'Usuario registrado correctamente';
        }

        // Usar SweetAlert Toast
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'title' => 'Éxito',
            'text' => $message
        ]);

        return redirect()->route('admin.users.index');
    }

    public function render()
    {
        return view('livewire.admin.user-form');
    }
}
