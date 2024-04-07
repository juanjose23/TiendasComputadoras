<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tallasproductos extends Model
{
    use HasFactory;
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
        return $this->HasMany('App\Models\Detalle_productos');
    }
}
