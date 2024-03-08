<?php

namespace App\Exports;

use App\Models\Modelos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ModelosExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Modelos::with(['marcas'])->get()->map(function ($modelos) {
            return [
                '#' => $modelos->id,
                'Nombre' => $modelos->nombre,
                'Marca'=>$modelos->marcas->nombre,
                'Descripción' => $modelos->descripcion,
                'Estado' => $modelos->estado == 1 ? 'Activo' : 'Inactivo'
            ];
        });
    }

    public function headings(): array
    {
        return [
            '#',
            'Nombre',
            'Marca',
            'Descripción',
            'Estado'
        ];
    }
}
