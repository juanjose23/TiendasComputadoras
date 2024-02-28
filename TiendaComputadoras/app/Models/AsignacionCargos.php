<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AsignacionCargos extends Model
{
    protected $table = 'asignacion_cargos';
    use HasFactory;
    public function cargos()
    {
        return $this-> belongsTo('App\Models\Cargos');
    }
    public function empleados()
    {
        return $this->belongsTo('App\Models\Empleados');
    }
}
