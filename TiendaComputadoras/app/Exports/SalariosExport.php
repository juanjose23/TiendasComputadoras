<?php

namespace App\Exports;

use App\Models\Salarios;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Empleados;
use Maatwebsite\Excel\Concerns\WithHeadings;
class SalariosExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return  Salarios::with(['empleados','empleados.personas', 'empleados.personas.persona_naturales'])->get()->map(function ($empleados) {
            // Obtener la URL de la foto de Cloudinary
          
            return [
                '#' => $empleados->id,
                'Código' => $empleados->empleados->codigo,
                'Nombre' => $empleados->empleados->personas->nombre,
                'Apellidos' => $empleados->empleados->personas->persona_naturales->apellido,
                'Salarios' => $empleados->salario,
                'Fecha de registro'=>$empleados->created_at,
                'Fecha de actualización'=>$empleados->updated_at,
                'Estado' => $empleados->estado == 1 ? 'Activo' : 'Inactivo'
            ];
        });
    }
    public function headings(): array
    {
        return [
            '#',
            'Código',
            'Nombre',
            'Apellidos',
            'Salarios',
            'Fecha de registro',
            'Fecha de actualizacion',
            'Estado'
        ];
    }
}
