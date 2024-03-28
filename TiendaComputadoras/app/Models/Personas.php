<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personas extends Model
{
    use HasFactory;
    public function persona_naturales()
    {
        return $this->HasOne('App\Models\Persona_Naturales');
    }
    public function persona_juridica()
    {
        return $this->HasOne('App\Models\Persona_Juridicas');
    }
    public function direcciones()
    {
        return $this->hasMany(Direcciones::class);
    }
    public function empleados()
    {
        return $this->HasOne('App\Models\Empleados');
    }
    public function users()
    {
        return $this->hasOne('App\Models\User');
    }

    
}
