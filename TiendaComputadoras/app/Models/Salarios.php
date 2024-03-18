<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salarios extends Model
{
    use HasFactory;

    public function empleados()
    {
        return $this->belongsTo('App\Models\Empleados');
    }

    /**
     * Obtiene el salario del colaborador con el ID proporcionado.
     *
     * @param int $colaboradorId El ID del colaborador.
     * @return mixed El salario del colaborador si se encuentra, de lo contrario, un mensaje indicando que no se ha asignado un salario.
     */
    public static function ObtenerSalarioColaborador($colaboradorId)
    {
        // Consulta para obtener el salario
        $salario = Salarios::where('empleados_id', $colaboradorId)
            ->where('estado', 1)
            ->first();

        // Verificar si se encontró un salario
        return $salario->salario ?? 'No se ha asignado un salario para este colaborador';
    }
    
    /**
     * Obtiene el historial de salarios del colaborador especificado.
     *
     * @param int $colaboradorId El ID del colaborador.
     * @return \Illuminate\Database\Eloquent\Collection|\App\Models\Salarios[] El historial de salarios del colaborador.
     */
    public static function obtenerHistorialSalarios($colaboradorId)
    {
        // Consulta para obtener el historial de salarios del colaborador
        $historialSalarios = Salarios::where('empleados_id', $colaboradorId)->get();

        return $historialSalarios ?? '';
    }
}
