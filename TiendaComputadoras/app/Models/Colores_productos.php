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
     * 
     */
    public static function ObtenerProductos()
    {
        $productos = Colores_productos::where('estado', 1)
            ->with(['colores','productos', 'productos.modelos', 'productos.modelos.marcas', 'productos.subcategorias'])
            ->whereNotIn('id', function ($query) {
                $query->select('productos_id')->from('precios');
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
    public static function ObtenerProductosConCategorias()
    {
        $productos = self::ObtenerProductos();


        $resultados = [];

        // Agrupar productos por subcategorías
        foreach ($productos as $producto) {
            $subcategoriaNombre = $producto->productos->subcategorias->categorias->nombre;
            $resultados[$subcategoriaNombre][$producto->productos->subcategorias->nombre][] = [
                'id' => $producto->id,
                'nombre' => $producto->productos->nombre,
                'marca' => $producto->productos->modelos->marcas->nombre,
                'modelo' => $producto->productos->modelos->nombre

            ];
        }
        return $resultados;
    }
}
