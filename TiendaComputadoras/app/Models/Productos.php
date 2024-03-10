<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Productos extends Model
{
    use HasFactory;
    public function modelos()
    {
        return $this->belongsTo('App\Models\Modelos');
    }
    public function subcategorias()
    {
        return $this->belongsTo('App\Models\Subcategorias');
    }
    public function coloresproductos()
    {
        return $this->hasMany('App\Models\Colores_productos');
    }
    public function detalles()
    {
        return $this->HasOne('App\Models\Detalle_productos');
    }
    public function imagenes()
    {
        return $this->morphMany('App\Models\Imagen', 'imagenable');
    }
    /**
     * Genera un SKU único para el producto.
     *
     * @param Productos $producto, subcategoria y modelo
     * @return string
     */
    public static function generarSkuProducto(Productos $producto, $idSubcategoria, $idModelo): string
    {
        // Obtener el nombre de la subcategoría y del modelo usando los IDs proporcionados
        $subcategoriaNombre = Subcategorias::find($idSubcategoria)->nombre;
        $modeloNombre = Modelos::find($idModelo)->nombre;
        $id=self::max('id');
        // Obtener la primera letra del nombre de la subcategoría y el modelo
        $subcategoriaInicial = Str::substr($subcategoriaNombre, 0, 1);
        $modeloInicial = Str::substr($modeloNombre, 0, 1);

        // Concatenar las iniciales de subcategoría y modelo con un 0 y el ID del producto
        $sku = $subcategoriaInicial . '-'.$modeloInicial .'-'. '0' . $id;

        return $sku;
    }
}
