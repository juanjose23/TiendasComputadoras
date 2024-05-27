<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contactosproveedores extends Model
{
    use HasFactory;

    public function personas()
    {
        return $this->belongsTo('App\Models\Personas');
    }
    public function proveedores()
    {
        return $this->belongsTo('App\Models\Proveedores');
    }

    public function paises()
    {
        return $this->belongsTo('App\Models\Pais');
    }
}
