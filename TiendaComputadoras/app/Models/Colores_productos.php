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
}
