<?php

namespace App\Exports;

use App\Models\Tallas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TallasExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Tallas::all()->map(function ($tallas) {
            return [
                '#' => $tallas->id,
                'Nombre' => $tallas->nombre,
                'Descripción'=>$tallas->descripcion,
                'Estado' => $tallas->estado == 1 ? 'Activo' : 'Inactivo'
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
