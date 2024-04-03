<?php

namespace App\Exports;

use App\Models\Cortes;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CortesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Cortes::all()->map(function ($corte) {
            return [
                '#' => $corte->id,
                'Nombre' => $corte->nombre,
                'Descripción'=>$corte->descripcion,
                'Estado' => $corte->estado == 1 ? 'Activo' : 'Inactivo'
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
