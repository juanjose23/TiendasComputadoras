<?php

namespace App\Exports;

use App\Models\Proveedores;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProveedoresExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return  Proveedores::with(['personas', 'personas.persona_naturales', 'personas.persona_naturales.paises','paises','personas.persona_juridicas'])->get()->map(function ($proveedores) {
           
            return [
                '#' => $proveedores->id,
                'Nombre' => $proveedores->personas->nombre,
                'Tipo de Proveedor' =>isset($proveedores->personas->persona_naturales->apellido) ? "Persona Natural" : "Persona Jurídica",
                'Apellidos o razon social' => isset($proveedores->personas->persona_naturales->apellido) ?  $proveedores->personas->persona_naturales->apellido : $proveedores->personas->persona_juridicas->razon_social,
                'Celular' => $proveedores->personas->telefono,
                'Telefono de planta'=>$proveedores->telefono,
                'Correo' => $proveedores->personas->correo,
                'Tipo de identificación' => isset($proveedores->personas->persona_naturales->tipo_identificacion) ? $proveedores->personas->persona_naturales->tipo_identificacion : "RUC",
                'Identificación' => isset($proveedores->personas->persona_naturales->identificacion) ? $proveedores->personas->persona_naturales->identificacion : $proveedores->personas->persona_juridicas->ruc,
                'Linea de distribucion' => $proveedores->sector_comercial,
                'Nacionalidad' => isset($proveedores->personas->persona_naturales->paises->nombre) ?$proveedores->personas->persona_naturales->paises->nombre :  $proveedores->paises->nombre,
                'Descripcion'=>$proveedores->descripcion,
                'Estado' => $proveedores->estado == 1 ? 'Activo' : 'Inactivo'
            ];
        });
    }

    public function headings(): array
    {
        return [
            '#',
            'Nombre',
            'Tipo de proveedor',
            'Apellidos o razon social',
            'Celular',
            'Telefono de planta',
            'Correo',
            'Tipo de identificación',
            'Identificación',
            'Linea de distribucion',
            'Nacionalidad',
            'Descripcion',
            'Estado'
        ];
    }
}
