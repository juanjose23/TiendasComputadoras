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
        return $this->belongsTo('App\Models\Cargos');
    }
    public function empleados()
    {
        return $this->belongsTo('App\Models\Empleados');
    }
    /**
     * Obtiene las asignaciones de cargos del colaborador especificado.
     *
     * @param int $colaboradorId El ID del colaborador.
     * @return \Illuminate\Database\Eloquent\Collection|\App\Models\AsignacionCargos[] Las asignaciones de cargos del colaborador si se encuentran, de lo contrario, un mensaje indicando que no se han asignado cargos.
     */

    public static function obtenerAsignacionesCargos($colaboradorId)
    {
        // Consulta para obtener las asignaciones de cargos activas del colaborador
        $asignaciones = AsignacionCargos::with('cargos')
            ->where('empleados_id', $colaboradorId)
            ->where('estado', 1)
            ->get();

        // Verificar si se encontraron asignaciones de cargos
        return $asignaciones;
    }
}
