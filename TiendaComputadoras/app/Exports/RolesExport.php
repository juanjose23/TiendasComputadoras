<?php

namespace App\Exports;

use App\Models\RolesModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RolesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RolesModel::all()->map(function ($rol) {
            return [
                '#' => $rol->id,
              
                'Nombre' => $rol->nombre,
                'Descripción' => $rol->descripcion,
               
                'Estado' => $rol->estado == 1 ? 'Activo' : 'Inactivo'
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
