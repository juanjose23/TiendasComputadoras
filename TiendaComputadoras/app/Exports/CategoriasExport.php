<?php

namespace App\Exports;

use App\Models\categorias;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class CategoriasExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
   
    public function collection()
    {
        return Categorias::all()->map(function ($cargo) {
            return [
                '#' => $cargo->id,
                'Nombre' => $cargo->nombre,
                'Descripción' => $cargo->descripcion,
                'Estado' => $cargo->estado == 1 ? 'Activo' : 'Inactivo'
            ];
        });
    }

    public function headings(): array
    {
        return [
            '#',
            'Nombre',
            'Descripción',
            'Estado'
        ];
    }
}
