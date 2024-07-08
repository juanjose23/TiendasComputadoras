<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud_compra extends Model
{
    protected $table="solicitud_compra";
    use HasFactory;
    public function empleados()
    {
        return $this->belongsTo('App\Models\Empleados','empleados_id');
    }
    public function detallessolicitud()
    {
        return $this->hasMany('App\Models\Detalle_solicitud_compra','solicitud_compras_id');
    }
}
