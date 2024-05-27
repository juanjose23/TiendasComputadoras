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
                'icono'=>'shopping-bag',
                'estado' => 1
            ],
            [
                'nombre' => 'Gestión de inventarios',
                'descripcion' => '',
                'icono'=>'archive',
                'estado' => 1
            ],
            [
                'nombre' => 'Gestión de compras',
                'descripcion' => '',
                'icono'=>'layout',
                'estado' => 1
            ],
            [
                'nombre' => 'Gestión de negocio',
                'descripcion' => '',
                'icono'=>'briefcase',
                'estado' => 1
            ],
            [
                'nombre' => 'Gestión de ventas',
                'descripcion' => '',
                'icono'=>'trending-up',
                'estado' => 1
            ],
            [
                'nombre' => 'Gestión de usuarios',
                'descripcion' => '',
                'icono'=>'users',
                'estado' => 1
            ],
        ];

        // Crear los modelos utilizando el array
        foreach ($modulos as $modulo) {
            ModelsModulos::create($modulo);
        }
    }
}
