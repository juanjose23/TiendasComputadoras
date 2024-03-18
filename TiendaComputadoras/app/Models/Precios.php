<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Precios extends Model
{
    use HasFactory;
    public function productoscolores()
    {
        return $this->belongsTo('App\Models\Colores_productos');
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
        $precio = Precios::where('productoscolores_id', $Idproducto)->first();

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
