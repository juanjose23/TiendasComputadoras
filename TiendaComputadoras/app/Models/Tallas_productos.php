<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tallas_productos extends Model
{
    use HasFactory;
    protected $table='tallasproductos';
    public function productos()
    {
        return $this->belongsTo('App\Models\Productos');
    }

    public function tallas()
    {
        return $this->belongsTo('App\Models\Tallas');
    }

    public function detalles()
    {
        return $this->hasMany('App\Models\Detalles_productos');
    }


/**
     * Obtener  Todas las tallas no asigandas a un productos 
     * filtrando  por el Id devolviendo un Array 
     */

     public static function ObtenerTallas($Idproducto)
     {
         $cortes = Tallas::whereNotIn('id', function($query) use ($Idproducto) {
             $query->select('tallas_id')
                   ->from('tallasproductos')
                   ->where('productos_id', $Idproducto);
         })->where('estado', 1)
         ->get();
         return $cortes;
     }
   
}
