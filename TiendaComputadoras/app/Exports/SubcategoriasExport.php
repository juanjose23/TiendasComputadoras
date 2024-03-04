<?php

namespace App\Exports;

use App\Models\subcategorias;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class SubcategoriasExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return subcategorias::with(['categorias'])->get()->map(function ($cargo) {
            return [
                '#' => $cargo->id,
                'Categoría'=>$cargo->categorias->nombre,
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
            'Categoría',
            'Nombre',
            'Descripción',
            'Estado'
        ];
    }
}
