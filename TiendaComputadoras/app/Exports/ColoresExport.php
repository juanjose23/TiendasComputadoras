<?php

namespace App\Exports;

use App\Models\Colores;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ColoresExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Colores::all()->map(function ($color) {
            return [
                '#' => $color->id,
                'Nombre' => $color->nombre,
                'Código'=>$color->codigo,
                'Estado' => $color->estado == 1 ? 'Activo' : 'Inactivo'
            ];
        });
    }

    public function headings(): array
    {
        return [
            '#',
            'Nombre',
            'Código',
            'Estado'
        ];
    }
}
