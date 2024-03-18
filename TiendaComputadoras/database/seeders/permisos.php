<?php

namespace Database\Seeders;

use App\Models\permisos as ModelsPermisos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class permisos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permisos = [
            [
                'nombre' => 'Crear',
                'estado'=>1
               
            ],
            [
                'nombre' => 'Editar',
                'estado'=>1
               
            ],
            [
                'nombre' => 'Eliminar',
                'estado'=>1
               
            ],
            [
                'nombre' => 'Aperturar',
                'estado'=>1
               
            ],
            [
                'nombre' => 'Arquear',
                'estado'=>1
               
            ],
            [
                'nombre' => 'Cerrar',
                'estado'=>1
               
            ],
            [
                'nombre' => 'Verificar',
                'estado'=>1
               
            ],
        ];

        // Crear los modelos utilizando el array
        foreach ($permisos as $permiso) {
            ModelsPermisos::create($permiso);
        }
    }
}
