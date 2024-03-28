<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::with(['personas', 'personas.persona_naturales', 'personas.empleados'])
        ->where('roles_id', '!=', 1)
        ->get()->map(function ($usuarios) {
            return [
                '#' => $usuarios->id,
                'Codigo'=>$usuarios->personas->empleados->codigo,
                'Nombre' => $usuarios->personas->nombre,
                'Apellido' => $usuarios->personas->persona_naturales->apellidos,
                'Usuario'=>$usuarios->usuario,
                'Estado' => $usuarios->estado == 1 ? 'Activo' : 'Inactivo'
            ];
        });
    }

    public function headings(): array
    {
        return [
            '#',
            'Codigo',
            'Nombre',
            'Apellido',
            'Rol',
            'Usuario',
            'Estado'
        ];
    }
}
