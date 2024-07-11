<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Precios extends Model
{
    use HasFactory;
    public function productosdetalles()
    {
        return $this->belongsTo('App\Models\Detalle_productos');
    }


    /**
     * Obtiene una colección de productos disponibles, considerando variantes 
     * como tallas, cortes, género, etc.
     * @return \Illuminate\Database\Eloquent\Collection
     */

    public function  ObtenerProductos()
    {
        $productos = Detalle_productos::with(['productos', 'tallasproductos', 'cortesproductos',  'tallasproductos.tallas', 'cortesproductos.cortes', 'coloresproductos', 'coloresproductos.colores', 'productos.modelos.marcas', 'productos.subcategorias.categorias', 'productos.subcategorias', 'generos'])->where('estado', 1)
            ->whereNotIn('id', function ($query) {
                $query->select('productosdetalles_id')->from('precios');
            })->get()
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
    public function  ObtenerProductosInventario()
    {
        $productos = Detalle_productos::with(['productos', 'tallasproductos', 'cortesproductos',  'tallasproductos.tallas', 'cortesproductos.cortes', 'coloresproductos', 'coloresproductos.colores', 'productos.modelos.marcas', 'productos.subcategorias.categorias', 'productos.subcategorias', 'generos'])->where('estado', 1)
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
    public function ObtenerProductosConCategorias()
    {
        $productos = self::ObtenerProductos();

        $resultados = [];
        // Agrupar productos por subcategorías
        foreach ($productos as $producto) {
            $subcategoriaNombre = $producto->productos->subcategorias->categorias->nombre;
            $resultados[$subcategoriaNombre][$producto->productos->subcategorias->nombre][] = [
                'id' => $producto->id,
                'codigo'=>$producto->productos->codigo, 
                'idproducto'=>$producto->productos->id,
                'nombre' => $producto->productos->nombre,
                'marca' => $producto->productos->modelos->marcas->nombre,
                'modelo' => $producto->productos->modelos->nombre,
                'color' => $producto->coloresproductos->colores->nombre,
                'tallas' => $producto->tallasproductos->tallas->nombre,
                'corte'=>$producto->cortesproductos->cortes->nombre
            ];
        }
        return $resultados;
    }
    public function ObtenerProductosConCategoriasInventario()
    {
        $productos = self::ObtenerProductosInventario();

        $resultados = [];
        // Agrupar productos por subcategorías
        foreach ($productos as $producto) {
            $subcategoriaNombre = $producto->productos->subcategorias->categorias->nombre;
            $resultados[$subcategoriaNombre][$producto->productos->subcategorias->nombre][] = [
                'id' => $producto->id,
                'codigo'=>$producto->productos->codigo, 
                'idproducto'=>$producto->productos->id,
                'nombre' => $producto->productos->nombre,
                'marca' => $producto->productos->modelos->marcas->nombre,
                'modelo' => $producto->productos->modelos->nombre,
                'color' => $producto->coloresproductos->colores->nombre,
                'tallas' => $producto->tallasproductos->tallas->nombre,
                'corte'=>$producto->cortesproductos->cortes->nombre
            ];
        }
        return $resultados;
    }
    public function  ObtenerProductosImagen($id)
    {
        $productos = Detalle_productos::with(['productos', 'tallasproductos', 'cortesproductos',  'tallasproductos.tallas', 'cortesproductos.cortes', 'coloresproductos', 'coloresproductos.colores', 'productos.modelos.marcas', 'productos.subcategorias.categorias', 'productos.subcategorias', 'generos'])->where('estado', 1)
           ->where('productos_id',$id)
           ->whereDoesntHave('imagenes', function ($query) {
            $query->select(DB::raw(1))
                  ->from('imagenes')
                  ->whereRaw('imagenes.imagenable_id = detallesproductos.id')
                  ->where('imagenes.imagenable_type', Detalle_productos::class);
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
    public function ObtenerProductosConCategoriasImagenes($id)
    {
        $productos = self::ObtenerProductosImagen($id);

        $resultados = [];
        // Agrupar productos por subcategorías
        foreach ($productos as $producto) {
            $subcategoriaNombre = $producto->productos->subcategorias->categorias->nombre;
            $resultados[$subcategoriaNombre][$producto->productos->subcategorias->nombre][] = [
                'id' => $producto->id,
                'codigo'=>$producto->productos->codigo, 
                'idproducto'=>$producto->productos->id,
                'nombre' => $producto->productos->nombre,
                'marca' => $producto->productos->modelos->marcas->nombre,
                'modelo' => $producto->productos->modelos->nombre,
                'color' => $producto->coloresproductos->colores->nombre,
                'tallas' => $producto->tallasproductos->tallas->nombre,
                'corte'=>$producto->cortesproductos->cortes->nombre
            ];
        }
        return $resultados;
    }

    /**
     * Busca el precio de un producto y actualiza su estado si se encuentra.
     *
     * @param int $Idproducto El ID del producto.
     * @return string|null Mensaje indicando el cambio de estado si se encontró el precio, de lo contrario, null.
     */
    public static function BuscarPreciosProductos($Idproducto)
    {
        // Buscar el precio del producto
        $precio = Precios::where('productosdetalles_id', $Idproducto)->first();

        // Verificar si se encontró el precio
        if ($precio) {
            // Actualizar el estado del precio a 2
            $precio->estado = 2;
            $precio->save();
            return "Se cambió el estado del precio del producto.";
        }

        return null;
    }
}
