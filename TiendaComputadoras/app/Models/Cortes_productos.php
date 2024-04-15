<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cortes_productos extends Model
{
    use HasFactory;
    protected $table="cortesproductos";
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
     * Obtener  Todos cortes no asigando a un productos 
     * filtrando  por el Id devolviendo un Array 
     */

     public static function ObtenerCortes($Idproducto)
     {
         $cortes = Cortes::whereNotIn('id', function($query) use ($Idproducto) {
             $query->select('cortes_id')
                   ->from('cortesproductos')
                   ->where('productos_id', $Idproducto);
         })->where('estado', 1)
         ->get();
         return $cortes;
     }
     
}
