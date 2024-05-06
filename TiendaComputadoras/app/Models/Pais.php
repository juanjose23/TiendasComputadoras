<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;
    public function Departamentos()
    {
        return $this->hasMany('App\Models\Departamentos');
    }
    public function marcas()
    {
        return $this->hasMany('App\Models\Marcas');
    }
    public function persona_natural()
    {
        return $this->HasOne('App\Models\Persona_Naturales');
    }
    public function proveedores()
    {
        return $this->HasOne('App\Models\Proveedores');
    }
    public static function obtenerPaises()
    {
        return self::select('id', 'nombre')->where('estado', 1)->get();
    }
    
}
