<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cortes_productos extends Model
{
    use HasFactory;
    protected $table = "cortesproductos";
    public function productos()
    {
        return $this->belongsTo('App\Models\Productos');
    }
    public function cortes()
    {
        return $this->belongsTo('App\Models\Cortes');
    }

    public function detalles()
    {
        return $this->HasMany('App\Models\Detalle_productos');
    }

    /**
     * Obtener los Cortes  disponibles para un producto filtrando por su ID.
     *
     * @param int $Idproducto El ID del producto.
     * @return \Illuminate\Database\Eloquent\Collection La colección de cortes disponibles para el producto.
     */
    public static function ObtenerCortes($Idproducto)
    {
        $cortes = Cortes::whereNotIn('id', function ($query) use ($Idproducto) {
            $query->select('cortes_id')
                ->from('cortesproductos')
                ->where('productos_id', $Idproducto);
        })->where('estado', 1)
            ->get();
        return $cortes;
    }
}
