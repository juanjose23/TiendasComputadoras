<?php

namespace App\Exports;

use App\Models\Marcas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MarcasExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Marcas::with(['paises'])->get()->map(function ($marca) {
            return [
                '#' => $marca->id,
                'Nombre' => $marca->nombre,
                'Sitio Web'=>$marca->sitio_web,
                'Nacionalidad'=>$marca->paises->nombre,
                'Descripción' => $marca->descripcion,
                'Estado' => $marca->estado == 1 ? 'Activo' : 'Inactivo'
            ];
        });
    }

    public function headings(): array
    {
        return [
            '#',
            'Nombre',
            'Sitio Web',
            'Nacionalidad',
            'Descripción',
            'Estado'
        ];
    }
}
