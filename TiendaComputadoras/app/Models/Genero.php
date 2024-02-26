<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    use HasFactory;
    public function persona_natural()
    {
        return $this->HasOne('App\Models\Persona_Naturales');
    }
    public static function obtenerGenero()
    {
        return self::select('id', 'nombre')->where('estado', 1)->get();
    }
}
