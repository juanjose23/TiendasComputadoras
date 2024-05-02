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
    public function detalles()
    {
        return $this->hasMany('App\Models\Detalles_productos');
    }

    /**
     * Obtener los colores disponibles para un producto filtrando por su ID.
     *
     * @param int $Idproducto El ID del producto.
     * @return \Illuminate\Database\Eloquent\Collection La colección de colores disponibles para el producto.
     */
    public static function ObtenerColoresProductos($Idproducto)
    {
        $colores = Colores::whereNotIn('id', function ($query) use ($Idproducto) {
            $query->select('colores_id')
                ->from('colores_productos')
                ->where('productos_id', $Idproducto);
        }) ->where('estado', 1)  ->get();

        return $colores;
    }

    

   
}
