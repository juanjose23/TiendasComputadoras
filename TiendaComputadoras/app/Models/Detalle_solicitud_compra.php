<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_solicitud_compra extends Model
{
    protected $table="detalle_solicitud_compra";
    use HasFactory;
    protected $fillable = [
        'solicitud_compras_id',
        'productosdetalles_id',
        'cantidad',
       
    ];
    public function solicitud_compra()
    {
        return $this->belongsTo('App\Models\Solicitud_compra','solicitud_compras_id');
    }

    public function productosdetalles()
    {
        return $this->belongsTo('App\Models\Detalle_productos','productosdetalles_id');
    }
    

}
