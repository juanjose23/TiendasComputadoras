<?php

namespace App\Exports;

use App\Models\Productos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductosExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Productos::with(['modelos', 'modelos.marcas', 'subcategorias', 'subcategorias.categorias', 'detalles', 'coloresproductos', 'imagenes'])->get()->map(function ($producto) {
            $colores = $producto->coloresproductos->pluck('colores.nombre')->implode(', ');
            return [
                'ID' => $producto->id,
                'Código' => $producto->codigo,
                'Nombre' => $producto->nombre,
                'Marca' => $producto->modelos->marcas->nombre,
                'Modelo' => $producto->modelos->nombre,
                'Categoría' => $producto->subcategorias->categorias->nombre,
                'Subcategoría' => $producto->subcategorias->nombre,
                'Descripción' => $producto->descripcion,
                'Fecha de lanzamiento' => $producto->fecha_lanzamiento,
                'Estado' => $producto->estado == 1 ? 'Activo' : 'Inactivo',
                'Dimensiones'=>$producto->detalles->dimensiones,
                'Peso'=>$producto->detalles->peso,
                'Material'=>$producto->detalles->material,
                'Instrucciones de Cuidado'=>$producto->detalles->instrucciones_cuidado,
                'Instrucciones de Montaje'=>$producto->detalles->instrucciones_montaje,
                'Características Especiales'=>$producto->detalles->caracteristicas_especiales,
                'Compatibilidad'=>$producto->detalles->compatibilidad,
                'Colores'=>$colores
            ];
        });
    }
    
    public function headings(): array
    {
        return [
            'ID',
            'Código',
            'Nombre',
            'Marca',
            'Modelo',
            'Categoría',
            'Subcategoría',
            'Descripción',
            'Fecha de Lanzamiento',
            'Estado',
            'Dimensiones',
            'Peso',
            'Material',
            'Instrucciones de Cuidado',
            'Instrucciones de Montaje',
            'Características Especiales',
            'Compatibilidad',
            'Colores'
            // Agrega aquí más encabezados si es necesario
        ];
    }
}
