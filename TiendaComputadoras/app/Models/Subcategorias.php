<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategorias extends Model
{
    use HasFactory;
    public function categorias()
    {
        return $this-> belongsTo('App\Models\Categorias');
    }
    public function productos()
    {
        return $this->hasOne('App\Models\Productos');
    }
    public static function ObtenerCategoriasConSubcategorias()
    {
        $categorias = Categorias::where('estado', 1)->with('subcategorias')->get();
    
        $resultados = [];
    
        foreach ($categorias as $subcategorias) {
            $nombreCategoria = $subcategorias->nombre;
    
            
            if ($subcategorias->subcategorias !== null && $subcategorias->subcategorias->count() > 0) { // Cambio aquí
                foreach ($subcategorias->subcategorias as $sub) {
                    $resultados[$nombreCategoria][] = [
                        'id' => $sub->id,
                        'nombre' => $sub->nombre
                    ];
                }
            }
        }
    
        return $resultados;
    }
}
