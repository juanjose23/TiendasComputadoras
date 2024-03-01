<?php

namespace App\Exports;

use App\Models\Cargos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CargosExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Cargos::all()->map(function ($cargo) {
            return [
                'ID' => $cargo->id,
                'Código'=>$cargo->codigo,
                'Nombre' => $cargo->nombre,
                'Descripción' => $cargo->descripcion,
                'Perfil' => $cargo->perfil,
                'Estado' => $cargo->estado == 1 ? 'Activo' : 'Inactivo'
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Descripción',
            'Perfil',
            'Estado'
        ];
    }
}

