<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona_Naturales extends Model
{
    protected $table = 'persona_naturales';
    use HasFactory;
    public function persona()
    {
        return $this->belongsTo('App\Models\Personas');
    }
    public function paises()
    {
        return $this->belongsTo('App\Models\Pais');
    }
    public function generos()
    {
        return $this->belongsTo('App\Models\Genero');
    }

}
