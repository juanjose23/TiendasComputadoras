<?php

namespace App\Exports;

use App\Models\Empleados;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ColaboradoresExport implements FromCollection, WithHeadings
{
    public function collection()
    {
     return  Empleados::with(['personas', 'personas.persona_naturales','personas.persona_naturales.paises'])->get()->map(function ($empleados) {
            // Obtener la URL de la foto de Cloudinary
          
            return [
                'ID' => $empleados->id,
                'Código' => $empleados->codigo,
                'Nombre' => $empleados->personas->nombre,
                'Apellidos' => $empleados->personas->persona_naturales->apellido,
                'Celular' => $empleados->personas->telefono,
                'Correo' => $empleados->personas->correo,
                'Tipo de identificación' => $empleados->personas->persona_naturales->tipo_identificacion,
                'Identificación' => $empleados->personas->persona_naturales->identificacion,
                'Código Inss' => $empleados->inss,
                'Nacionalidad' => $empleados->personas->persona_naturales->paises->nombre,
                'Estado' => $empleados->estado == 1 ? 'Activo' : 'Inactivo'
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Código',
            'Nombre',
            'Apellidos',
            'Celular',
            'Correo',
            'Tipo de identificación',
            'Identificación',
            'Código Inss',
            'Nacionalidad',
            'Estado'
        ];
    }

  
    
}
