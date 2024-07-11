<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lotes extends Model
{
    protected $table = 'lote';
    use HasFactory;
  
    
    public function detalleslotes()
    {
        return $this->hasMany('App\Models\Lotes');
    }


    public function proveedores()
    {
        return $this->belongsTo(Proveedores::class);
    }
    public function empleados()
    {
        return $this->belongsTo(Empleados::class);
    }
   
}
