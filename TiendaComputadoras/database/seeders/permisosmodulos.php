<?php

namespace Database\Seeders;

use App\Models\permisosmodulos as ModelsPermisosmodulos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class permisosmodulos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 
        $permisosmodulos = [
            [
                'modulos_id' => 1,
                'permisos_id'=>1,
                'estado'=>1
               
            ],
            [
                'modulos_id' => 1,
                'permisos_id'=>2,
                'estado'=>1
               
            ],
            [
                'modulos_id' => 1,
                'permisos_id'=>3,
                'estado'=>1
               
            ],
           
            [
                'modulos_id' => 2,
                'permisos_id'=>1,
                'estado'=>1
               
            ],
            [
                'modulos_id' => 2,
                'permisos_id'=>2,
                'estado'=>1
               
            ],
            [
                'modulos_id' => 2,
                'permisos_id'=>3,
                'estado'=>1
               
            ],
            [
                'modulos_id' => 3,
                'permisos_id'=>1,
                'estado'=>1
               
            ],
            [
                'modulos_id' => 3,
                'permisos_id'=>2,
                'estado'=>1
               
            ],
            [
                'modulos_id' => 3,
                'permisos_id'=>3,
                'estado'=>1
               
            ],
            [
                'modulos_id' => 4,
                'permisos_id'=>1,
                'estado'=>1
               
            ],
            [
                'modulos_id' => 4,
                'permisos_id'=>2,
                'estado'=>1
               
            ],
            [
                'modulos_id' => 4,
                'permisos_id'=>3,
                'estado'=>1
               
            ],
            [
                'modulos_id' => 5,
                'permisos_id'=>1,
                'estado'=>1
               
            ],
            [
                'modulos_id' => 5,
                'permisos_id'=>2,
                'estado'=>1
               
            ],
            [
                'modulos_id' => 5,
                'permisos_id'=>3,
                'estado'=>1
               
            ],
            [
                'modulos_id' => 6,
                'permisos_id'=>1,
                'estado'=>1
               
            ],
            [
                'modulos_id' => 6,
                'permisos_id'=>2,
                'estado'=>1
               
            ],
            [
                'modulos_id' => 6,
                'permisos_id'=>3,
                'estado'=>1
               
            ],
            [
                'modulos_id' => 6,
                'permisos_id'=>7,
                'estado'=>1
               
            ],
        ];

        // Crear los modelos utilizando el array
        foreach ($permisosmodulos as $permiso) {
            ModelsPermisosmodulos::create($permiso);
        }
    }
}
