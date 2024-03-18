<?php

namespace App\Exports;

use App\Models\Precios;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class PreciosExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Precios::with(['productoscolores','productoscolores.productos','productoscolores.productos.modelos', 'productoscolores.productos.modelos.marcas', 'productoscolores.productos.subcategorias', 'productoscolores.productos.subcategorias.categorias', 'productoscolores.productos.detalles', 'productoscolores.colores'])->get()->map(function ($precios) {
            return [
                'ID' => $precios->productoscolores->productos->id,
                'Código' => $precios->productoscolores->productos->codigo,
                'Nombre' => $precios->productoscolores->productos->nombre,
                'Marca' => $precios->productoscolores->productos->modelos->marcas->nombre,
                'Modelo' => $precios->productoscolores->productos->modelos->nombre,
                'Categoría' => $precios->productoscolores->productos->subcategorias->categorias->nombre,
                'Subcategoría' => $precios->productoscolores->productos->subcategorias->nombre,
                'Descripción' => $precios->productoscolores->productos->descripcion,
                'Fecha de lanzamiento' => $precios->productoscolores->productos->fecha_lanzamiento,
                'Estado del producto' => $precios->productoscolores->productos->estado == 1 ? 'Activo' : 'Inactivo',
                'Dimensiones'=>$precios->productoscolores->productos->detalles->dimensiones,
                'Peso'=>$precios->productoscolores->productos->detalles->peso,
                'Material'=>$precios->productoscolores->productos->detalles->material,
                'Instrucciones de Cuidado'=>$precios->productoscolores->productos->detalles->instrucciones_cuidado,
                'Instrucciones de Montaje'=>$precios->productoscolores->productos->detalles->instrucciones_montaje,
                'Características Especiales'=>$precios->productoscolores->productos->detalles->caracteristicas_especiales,
                'Compatibilidad'=>$precios->productoscolores->productos->detalles->compatibilidad,
                'Colores'=>$precios->productoscolores->colores->nombre,
                'Estado del precio'=>$precios->estado == 1 ? 'Activo':'Inactivo'
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
            'Estado del producto',
            'Dimensiones',
            'Peso',
            'Material',
            'Instrucciones de Cuidado',
            'Instrucciones de Montaje',
            'Características Especiales',
            'Compatibilidad',
            'Color',
            'Estado del precio'
            // Agrega aquí más encabezados si es necesario
        ];
    }
}
