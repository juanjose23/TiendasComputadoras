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
                'enlace'=>'colores.index',
                'estado' => 1
            ],
            [
                'modulos_id'=>1,
                'nombre' => 'Cortes',
                'descripcion' => '',
                'enlace'=>'colores.index',
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
                'enlace'=>'',
                'estado' => 1
            ],
            [
                'modulos_id'=>2,
                'nombre' => 'Stock',
                'descripcion' => '',
                'enlace'=>'',
                'estado' => 1
            ],
            [
                'modulos_id'=>2,
                'nombre' => 'Movimientos',
                'descripcion' => '',
                'enlace'=>'',
                'estado' => 1
            ],
            [
                'modulos_id'=>3,
                'nombre' => 'Solicitudes',
                'descripcion' => '',
                'enlace'=>'',
                'estado' => 1
            ],
            [
                'modulos_id'=>3,
                'nombre' => 'Cotizaciones',
                'descripcion' => '',
                'enlace'=>'',
                'estado' => 1
            ],
            [
                'modulos_id'=>3,
                'nombre' => 'Ordenes de compras',
                'descripcion' => '',
                'enlace'=>'',
                'estado' => 1
            ],
            [
                'modulos_id'=>3,
                'nombre' => 'Devoluciones de compras',
                'descripcion' => '',
                'enlace'=>'',
                'estado' => 1
            ],
            [
                'modulos_id'=>3,
                'nombre' => 'Recepciones de compras',
                'descripcion' => '',
                'enlace'=>'',
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
                'enlace'=>'empleados.index',
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
                'descripcion' => '',
                'enlace'=>'salarios.index',
                'estado' => 1
            ],
            [
                'modulos_id'=>5,
                'nombre' => 'Pedidos',
                'descripcion' => '',
                'enlace'=>'',
                'estado' => 1
            ],
            [
                'modulos_id'=>5,
                'nombre' => 'Cotizaciones de venta',
                'descripcion' => '',
                'enlace'=>'',
                'estado' => 1
            ],
            [
                'modulos_id'=>5,
                'nombre' => 'Ventas',
                'descripcion' => '',
                'enlace'=>'',
                'estado' => 1
            ],
            [
                'modulos_id'=>5,
                'nombre' => 'Entregas',
                'descripcion' => '',
                'enlace'=>'',
                'estado' => 1
            ],
            [
                'modulos_id'=>6,
                'nombre' => 'Cajas',
                'descripcion' => '',
                'enlace'=>'',
                'estado' => 1
            ],
            [
                'modulos_id'=>6,
                'nombre' => 'Apertura',
                'descripcion' => '',
                'enlace'=>'',
                'estado' => 1
            ],
            [
                'modulos_id'=>6,
                'nombre' => 'Arqueo',
                'descripcion' => '',
                'enlace'=>'',
                'estado' => 1
            ],
            [
                'modulos_id'=>6,
                'nombre' => 'Cierre',
                'descripcion' => '',
                'enlace'=>'',
                'estado' => 1
            ],
            [
                'modulos_id'=>6,
                'nombre' => 'Configuraciones',
                'descripcion' => '',
                'enlace'=>'',
                'estado' => 1
            ],
            [
                'modulos_id'=>7,
                'nombre' => 'Roles',
                'descripcion' => '',
                'enlace'=>'roles.index',
                'estado' => 1
            ],
            [
                'modulos_id'=>7,
                'nombre' => 'Usuarios',
                'descripcion' => '',
                'enlace'=>'usuarios.index',
                'estado' => 1
            ],
            [
                'modulos_id'=>7,
                'nombre' => 'Privilegios',
                'descripcion' => '',
                'enlace'=>'',
                'estado' => 1
            ],
            [
                'modulos_id'=>7,
                'nombre' => 'Permisos',
                'descripcion' => '',
                'enlace'=>'',
                'estado' => 1
            ],
            [
                'modulos_id'=>7,
                'nombre' => 'Conexiones',
                'descripcion' => '',
                'enlace'=>'',
                'estado' => 1
            ]

        ];

        // Crear los modelos utilizando el array
        foreach ($submodulos as $submodulo) {
            ModelsSubmodulos::create($submodulo);
        }
    }
}
