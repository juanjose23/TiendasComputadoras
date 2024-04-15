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


    public function tallasproductos()
    {
        return $this->BelongsTo('App\Models\Tallas_productos');
    }

    public function coloresproductos()
    {
        return $this->BelongsTo('App\Models\Colores_productos');
    }
   
    public function cortesproductos()
    {
        return $this->BelongsTo('App\Models\Cortes_Productos');
    }

    public function generos()
    {
        return $this->belongsTo('App\Models\Genero');
    }
}
