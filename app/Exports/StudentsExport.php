<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return User::where('role', 'student')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Nombre', 'Email', 'DNI', 'Celular', 'Fecha Registro'];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->dni,
            $user->phone, // Nuevo campo
            $user->created_at->format('d/m/Y'),
        ];
    }
}
