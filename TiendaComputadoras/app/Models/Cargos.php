<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargos extends Model
{
    use HasFactory;
    public function asignaciones()
    {
        return $this->hasMany('App\Models\AsingacionCargos');
    }
    public static function generarCodigo(string $perfil): string
    {
        
        $maxId = self::max('id');
     
        $numero = $maxId + 1;
        $iniciales = '';
        foreach (explode(' ', $perfil) as $palabra) {
            $iniciales .= strtoupper(substr($palabra, 0, 1));
        }
        
        // Combina las iniciales del perfil con el número consecutivo para formar el código del cargo
        $codigo = $iniciales . '-' . $numero;
        
        return $codigo;
    }
}
