<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalles_Lotes extends Model
{
    use HasFactory;
    protected $table="detalles_lotes";
    public function lotes()
    {
        return $this->belongsTo('App\Models\Lotes');
    }
    public function productosdetalles()
    {
        return $this->belongsTo('App\Models\Detalle_productos','productosdetalles_id');
    }

   
}
