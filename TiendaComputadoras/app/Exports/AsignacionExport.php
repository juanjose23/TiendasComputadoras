<?php

namespace App\Exports;

use App\Models\AsignacionCargos;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class AsignacionExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function collection()
    {
        $asignaciones = AsignacionCargos::with(['empleados', 'empleados.personas', 'cargos'])->get();

        return $asignaciones->map(function($asignacion) {
            return [
                'Código' => $asignacion->empleados->codigo,
                'Nombre' => $asignacion->empleados->personas->nombre,
                'Apellido' => $asignacion->empleados->personas->persona_naturales->apellidos,
                'Cargo en función' => $asignacion->cargos->nombre,
                'Perfil del cargo' => $asignacion->cargos->perfil,
                'Fecha de registro' => $asignacion->created_at,
                'Fecha de actualización' => $asignacion->updated_at, // Se corrigió "Updated_at" a "updated_at"
                'Estado' => $asignacion->estado == 1 ? 'Activo' : 'Inactivo'
            ];
        });
    }
    public function headings(): array
    {
        return [
            'Código',
            'Nombre',
            'Apellido',
            'Cargo en función',
            'Perfil del cargo',
            'Fecha de registro',
            'Fecha de actualizacion',
            'Estado'
        ];
    }
   
}
