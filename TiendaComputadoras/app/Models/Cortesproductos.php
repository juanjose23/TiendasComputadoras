<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cortesproductos extends Model
{
    use HasFactory;

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
    
}
