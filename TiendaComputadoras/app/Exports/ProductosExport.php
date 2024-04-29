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
        return Productos::with(['modelos', 'modelos.marcas', 'subcategorias', 'subcategorias.categorias', 'detalles', 'coloresproductos', 'cortesproductos', 'tallasproductos', 'detalles.generos', 'imagenes'])->get()->map(function ($producto) {
            $colores = $producto->coloresproductos->pluck('colores.nombre')->implode(', ');
            $cortes = $producto->cortesproductos->pluck('cortes.nombre')->implode(', ');
            $tallas = $producto->tallasproductos->pluck('tallas.nombre')->implode(', ');

            // Obtener los géneros de cada detalle
            $generos = $producto->detalles->map(function ($detalle) {
                return $detalle->generos->nombre;
            })->unique()->implode(', ');
    

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
                'Generos' => $generos,
                'Cortes' => $cortes,
                'Tallas' => $tallas,
                'Colores' => $colores
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
            'Generos',
            'Cortes',
            'Tallas',
            'Colores'
            // Agrega aquí más encabezados si es necesario
        ];
    }
}
