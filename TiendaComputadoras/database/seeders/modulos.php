<?php

namespace Database\Seeders;

use App\Models\modulos as ModelsModulos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class modulos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $modulos = [
            [
                'nombre' => 'Gestión de Productos',
                'descripcion' => '',
                'icono'=>'<i class="align-middle" data-feather="shopping-bag"></i>',
                'estado' => 1
            ],
            [
                'nombre' => 'Gestión de inventarios',
                'descripcion' => '',
                'icono'=>'<i class="align-middle" data-feather="archive"></i>',
                'estado' => 1
            ],
            [
                'nombre' => 'Gestión de compras',
                'descripcion' => '',
                'icono'=>'<i class="align-middle" data-feather="layout"></i>',
                'estado' => 1
            ],
            [
                'nombre' => 'Gestión de negocio',
                'descripcion' => '',
                'icono'=>'<i class="align-middle" data-feather="briefcase"></i>',
                'estado' => 1
            ],
            [
                'nombre' => 'Gestión de ventas',
                'descripcion' => '',
                'icono'=>' <i class="align-middle" data-feather="trending-up"></i>',
                'estado' => 1
            ],
            [
                'nombre' => 'Gestión de caja',
                'descripcion' => '',
                'icono'=>'<i class="align-middle" data-feather="box"></i>',
                'estado' => 1
            ],
            [
                'nombre' => 'Gestión de usuarios',
                'descripcion' => '',
                'icono'=>' <i class="align-middle" data-feather="users"></i>',
                'estado' => 1
            ],
        ];

        // Crear los modelos utilizando el array
        foreach ($modulos as $modulo) {
            ModelsModulos::create($modulo);
        }
    }
}
