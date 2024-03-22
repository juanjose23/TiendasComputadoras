<?php

namespace Database\Seeders;

use App\Models\RolesModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    //
    public function run()
    {
        $roles = [
            [
                'nombre' => 'Clientes',
                'descripcion' =>null,
                'estado' => 1,
            ],
            [
                'nombre' => 'Administrador del Sistema',
                'descripcion' => 'Tiene acceso completo a todas las funciones del sistema.',
                'estado' => 1,
            ],

            [
                'nombre' => 'Gerente de Ventas',
                'descripcion' => 'Responsable de la gestión de ventas y clientes.',
                'estado' => 1,
            ],

            [
                'nombre' => 'Gerente de Compras',
                'descripcion' => 'Encargado de gestionar las compras de productos y proveedores.',
                'estado' => 1,
            ],
            [
                'nombre' => 'Vendedor',
                'descripcion' => 'Responsable de interactuar con los clientes y realizar ventas.',
                'estado' => 1,
            ],
            [
                'nombre' => 'Asistente de Almacén',
                'descripcion' => 'Encargado de gestionar el inventario y la logística.',
                'estado' => 1,
            ]
        ];

        // Crear los modelos utilizando el array
        foreach ($roles as $rol) {
            RolesModel::create($rol);
        }
    }
}
