<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    use HasFactory;
    public function personas()
    {
        return $this->belongsTo('App\Models\Personas');
    }
    
    public function paises()
    {
        return $this->belongsTo('App\Models\Pais');
    }
}
