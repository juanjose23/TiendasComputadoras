<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colores_productos extends Model
{
    protected $table = 'colores_productos';
    use HasFactory;
    public function productos()
    {
        return $this->belongsTo('App\Models\Productos');
    }
    public function colores()
    {
        return $this->belongsTo('App\Models\Colores');
    }
    public function precios()
    {
        return $this->hasMany('App\Models\Precios');
    }
    /**
     * Obtiene los productos disponibles.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function ObtenerProductos()
    {
        // Obtiene los productos con ciertas relaciones y criterios de filtrado
        $productos = Colores_productos::where('estado', 1)
            ->with(['colores', 'productos', 'productos.modelos', 'productos.modelos.marcas', 'productos.subcategorias'])
            ->whereNotIn('id', function ($query) {
                $query->select('productoscolores_id')->from('precios');
            })
            ->get()
            ->sortBy([
                function ($producto) {
                    return $producto->productos->subcategorias->nombre;
                },
                function ($producto) {
                    return $producto->productos->nombre;
                },
                function ($producto) {
                    return $producto->id;
                },
            ]);

        return $productos;
    }

    /**
     * Obtiene los productos agrupados por categorías y subcategorías.
     * 
     * @return array
     */
    public static function ObtenerProductosConCategorias()
    {
        $productos = self::ObtenerProductos();

        $resultados = [];

        // Agrupar productos por subcategorías
        foreach ($productos as $producto) {
            $subcategoriaNombre = $producto->productos->subcategorias->categorias->nombre;
            $resultados[$subcategoriaNombre][$producto->productos->subcategorias->nombre][] = [
                'id' => $producto->id,
                'codigo'=>$producto->productos->codigo,
                'nombre' => $producto->productos->nombre,
                'marca' => $producto->productos->modelos->marcas->nombre,
                'modelo' => $producto->productos->modelos->nombre,
                'color' => $producto->colores->nombre
            ];
        }
        return $resultados;
    }

    /**
     * Busca el ID del producto asociado al ID de color.
     * 
     * @param int $id El ID del color del producto.
     * @return int|null El ID del producto o null si no se encuentra.
     */
    public static function BuscarIdproducto($id)
    {
        $Producto = Colores_productos::find($id);
        if ($Producto) {
            return $Producto->productos_id;
        }
        return null;
    }
}
