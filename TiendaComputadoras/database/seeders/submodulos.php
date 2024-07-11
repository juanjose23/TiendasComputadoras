<?php

namespace Database\Seeders;

use App\Models\submodulos as ModelsSubmodulos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class submodulos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $submodulos = [
            [
                'modulos_id'=>1,
                'nombre' => 'Categoría',
                'descripcion' => '',
                'enlace'=>'categorias.index',
                'estado' => 1
            ],
            [
                'modulos_id'=>1,
                'nombre' => 'SubCategoría',
                'descripcion' => '',
                'enlace'=>'subcategorias.index',
                'estado' => 1
            ],
            [
                'modulos_id'=>1,
                'nombre' => 'Marcas',
                'descripcion' => '',
                'enlace'=>'marcas.index',
                'estado' => 1
            ],
            [
                'modulos_id'=>1,
                'nombre' => 'Modelos',
                'descripcion' => '',
                'enlace'=>'modelos.index',
                'estado' => 1
            ],
            [
                'modulos_id'=>1,
                'nombre' => 'Colores',
                'descripcion' => '',
                'enlace'=>'colores.index',
                'estado' => 1
            ],
            [
                'modulos_id'=>1,
                'nombre' => 'Tallas',
                'descripcion' => '',
                'enlace'=>'tallas.index',
                'estado' => 1
            ],
            [
                'modulos_id'=>1,
                'nombre' => 'Cortes',
                'descripcion' => '',
                'enlace'=>'cortes.index',
                'estado' => 1
            ],
            [
                'modulos_id'=>1,
                'nombre' => 'Productos',
                'descripcion' => '',
                'enlace'=>'productos.index',
                'estado' => 1
            ],
            [
                'modulos_id'=>1,
                'nombre' => 'Precios',
                'descripcion' => '',
                'enlace'=>'precios.index',
                'estado' => 1
            ],
            [
                'modulos_id'=>2,
                'nombre' => 'Proveedores',
                'descripcion' => '',
                'enlace'=>'proveedores.index',
                'estado' => 1
            ],
            [
                'modulos_id'=>2,
                'nombre' => 'Stock',
                'descripcion' => '',
                'enlace'=>'lotes.index',
                'estado' => 1
            ],
           
            [
                'modulos_id'=>3,
                'nombre' => 'Solicitudes',
                'descripcion' => '',
                'enlace'=>'solicitud.index',
                'estado' => 1
            ],
           
            [
                'modulos_id'=>3,
                'nombre' => 'Ordenes de compras',
                'descripcion' => '',
                'enlace'=>null,
                'estado' => 1
            ],
            [
                'modulos_id'=>3,
                'nombre' => 'Devoluciones de compras',
                'descripcion' => '',
                'enlace'=>null,
                'estado' => 1
            ],
          
            [
                'modulos_id'=>4,
                'nombre' => 'Cargos',
                'descripcion' => '',
                'enlace'=>'cargos.index',
                'estado' => 1
            ],
            [
                'modulos_id'=>4,
                'nombre' => 'Empleados',
                'descripcion' => '',
                'enlace'=>'colaboradores.index',
                'estado' => 1
            ],
            [
                'modulos_id'=>4,
                'nombre' => 'Asignacion de cargos',
                'descripcion' => '',
                'enlace'=>'asignaciones.index',
                'estado' => 1
            ],
            [
                'modulos_id'=>4,
                'nombre' => 'Salarios',
                'descripcion' =>'',
                'enlace'=>'salarios.index',
                'estado' => 1
            ],
          
            [
                'modulos_id'=>5,
                'nombre' => 'Ventas',
                'descripcion' => '',
                'enlace'=>null,
                'estado' => 1
            ],
            [
                'modulos_id'=>5,
                'nombre' => 'Entregas',
                'descripcion' => '',
                'enlace'=>null,
                'estado' => 1
            ],
            [
                'modulos_id'=>6,
                'nombre' => 'Roles',
                'descripcion' => '',
                'enlace'=>'roles.index',
                'estado' => 1
            ],
            [
                'modulos_id'=>6,
                'nombre' => 'Usuarios',
                'descripcion' => '',
                'enlace'=>'usuarios.index',
                'estado' => 1
            ],
            [
                'modulos_id'=>6,
                'nombre' => 'Privilegios',
                'descripcion' => '',
                'enlace'=>'privilegios.index',
                'estado' => 1
            ],
            [
                'modulos_id'=>6,
                'nombre' => 'Permisos',
                'descripcion' => '',
                'enlace'=>'permisos.index',
                'estado' => 1
            ],
            [
                'modulos_id'=>6,
                'nombre' => 'Conexiones',
                'descripcion' => '',
                'enlace'=>null,
                'estado' => 1
            ],
            [
                'modulos_id'=>4,
                'nombre' => 'Comapañia',
                'descripcion' => '',
                'enlace'=>'empresa.index',
                'estado' => 1
            ]

        ];

        // Crear los modelos utilizando el array
        foreach ($submodulos as $submodulo) {
            ModelsSubmodulos::create($submodulo);
        }
    }
}
