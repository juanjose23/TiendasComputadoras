<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelos extends Model
{
    use HasFactory;
    public function marcas()
    {
        return $this->belongsTo('App\Models\Marcas');
    }

    public function productos()
    {
        return $this->hasOne('App\Models\Productos');
    }
    public static function ObtenerMarcasConModelos()
    {
        $marcas = Marcas::where('estado', 1)->with('modelos')->get();
    
        $resultados = [];
    
        foreach ($marcas as $marca) {
            $nombremarca = $marca->nombre;
    
            
            if ($marca->modelos !== null && $marca->modelos->count() > 0) { // Cambio aquí
                foreach ($marca->modelos as $modelo) {
                    $resultados[$nombremarca][] = [
                        'id' => $modelo->id,
                        'nombre' => $modelo->nombre
                    ];
                }
            }
        }
    
        return $resultados;
    }
}
