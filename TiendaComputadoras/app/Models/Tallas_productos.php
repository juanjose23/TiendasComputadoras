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



   
}
