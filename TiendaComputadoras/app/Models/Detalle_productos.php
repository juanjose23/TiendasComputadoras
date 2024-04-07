<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Detalle_productos extends Model
{
    protected $table = 'detallesproductos';
    use HasFactory;

    public function productos()
    {
        return $this->BelongsTo('App\Models\Productos');
    }
    public function precios()
    {
        return $this->hasMany('App\Models\Precios');
    } 
  
    public function colores()
    {
        return $this->belongsTo('App\Models\Colores_productos');
    }
  
    public function cortes()
    {
        return $this->belongsTo('App\Models\Cortesproductos');
    }

    
    public function tallas()
    {
        return $this->belongsTo('App\Models\Tallasproductos');
    }

    public function generos()
    {
        return $this->belongsTo('App\Models\Productos');
    }
   
}
