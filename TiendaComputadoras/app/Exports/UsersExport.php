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
        $usuarios = User::with(['personas', 'personas.persona_naturales', 'personas.empleados', 'rolesusuarios', 'rolesusuarios.rolesmodel'])
            ->whereHas('rolesusuarios', function ($query) {
                $query->where('roles_id', '!=', 1);
            })
            ->get();

        $usuariosTransformados = $usuarios->map(function ($usuario) {
            // Obtener todos los nombres de los roles del usuario actual y unirlos en una sola cadena
            $nombresRoles = $usuario->rolesusuarios->pluck('rolesmodel.nombre')->implode(', ');

            return [
                '#' => $usuario->id,
                'Codigo' => $usuario->personas->empleados->codigo,
                'Nombre' => $usuario->personas->nombre,
                'Apellido' => $usuario->personas->persona_naturales->apellido,
                'Rol' => $nombresRoles, // Usar la cadena concatenada de roles
                'Usuario' => $usuario->usuario,
                'Estado' => $usuario->estado == 1 ? 'Activo' : 'Inactivo'
            ];
        });

        return $usuariosTransformados;
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
