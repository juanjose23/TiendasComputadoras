<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marcas extends Model
{
    use HasFactory;
    public function imagenes()
    {
        return $this->morphMany('App\Models\Imagen', 'imagenable');
    }
    public function paises()
    {
        return $this->belongsTo('App\Models\Pais');
    }
    public function modelos()
    {
        return $this->hasMany('App\Models\Modelos');
    }
}
