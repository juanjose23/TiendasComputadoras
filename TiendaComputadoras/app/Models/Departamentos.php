<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    use HasFactory;
    public function paises()
    {
        return $this->belongsTo('App\Models\Pais');
    }
    public function municipios()
    {
        return $this->hasMany('App\Models\Municipios');
    }
    
    public static function ObtenerDepartamentosConMunicipios()
    {
        $departamentos = Departamentos::where('estado', 1)->with('municipios')->get();
    
        $resultados = [];
    
        foreach ($departamentos as $departamento) {
            $nombreDepartamento = $departamento->nombre;
    
            // Verifica si el departamento tiene municipios asociados
            if ($departamento->municipios !== null && $departamento->municipios->count() > 0) { // Cambio aquí
                foreach ($departamento->municipios as $municipio) {
                    $resultados[$nombreDepartamento][] = [
                        'id' => $municipio->id,
                        'nombre' => $municipio->nombre
                    ];
                }
            } else {
                // Si no hay municipios asociados al departamento, agregar un mensaje
                $resultados[$nombreDepartamento] = 'No se encontraron municipios';
            }
        }
    
        return $resultados;
    }
    
}
