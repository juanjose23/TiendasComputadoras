<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class submodulos extends Model
{
    use HasFactory;
    public function modulos()
    {
        return $this->belongsTo('App\Models\modulos');
    }
    public function privilegios()
    {
        return $this->hasMany('App\Models\Privilegios');
    }

    /**
     * 
     */

     public static function ObtenerModulosConSubmodulos()
     {
         $modulos = Modulos::where('estado', 1)->with('submodulos')->get();
     
         $resultados = [];
     
         // Recopilar la cantidad de submódulos por cada módulo
         foreach ($modulos as $modulo) {
             $nombreModulo = $modulo->nombre;
             $cantidadSubmodulos = $modulo->submodulos->count();
     
             // Almacenar la cantidad de submódulos para cada módulo
             $resultados[] = [
                 'nombre' => $nombreModulo,
                 'id'=>$modulo->id,
                 'cantidad_submodulos' => $cantidadSubmodulos,
                 'submodulos' => $modulo->submodulos->toArray()
             ];
         }
     
         // Ordenar los módulos por la cantidad de submódulos (de menor a mayor)
         usort($resultados, function($a, $b) {
             return $a['cantidad_submodulos'] - $b['cantidad_submodulos'];
         });
     
         return $resultados;
     }
     
}
