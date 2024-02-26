<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado_civiles extends Model
{
    use HasFactory;
    public function empleados()
    {
        return $this->HasOne('App\Models\Empleados');
    }
    public static function obtenerEstados()
    {
        return self::select('id', 'nombre')->get();
    }
}
