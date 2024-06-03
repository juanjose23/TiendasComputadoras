<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lotes extends Model
{
    protected $table = 'lote';
    use HasFactory;
    public function movimientos()
    {
        return $this->belongsTo('App\Models\movimiento','movimiento_id');
    }
    public function productosdetalles()
    {
        return $this->belongsTo('App\Models\Detalle_productos');
    }

    public function inventarios()
    {
        return $this->hasMany('App\Models\Inventarios');
    }

     
   
}
