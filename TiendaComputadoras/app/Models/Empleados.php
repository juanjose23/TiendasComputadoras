<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleados extends Model
{
    use HasFactory;
    public function persona()
    {
        return $this->belongsTo('App\Models\Personas');
    }
    public function estado_civiles()
    {
        return $this->belongsTo('App\Models\Estado_civiles');
    }
    public static function generarCodigo()
    {
        // Obtener el ID máximo actual de la tabla empleados
        $ultimoId = self::max('id');
        
        // Generar el nuevo código sumando 1 al ID máximo obtenido
        $nuevoCodigo = 'EMP-' . str_pad($ultimoId + 1, 3, '0', STR_PAD_LEFT);
        
        return $nuevoCodigo;
    }
}
