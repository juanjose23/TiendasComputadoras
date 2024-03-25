<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Privilegios extends Model
{
    protected $table = 'privilegiosroles';
    use HasFactory;

    public function roles()
    {
        return $this->belongsTo('App\Models\RolesModel');
    }

    public function submodulos()
    {
        return $this->belongsTo('App\Models\submodulos');
    }
    /**
     * Mostrar los módulos y submódulos faltantes por rol.
     *
     * Esta función recibe como parámetro el ID de un rol y se encarga de mostrar
     * los módulos y submódulos que no están asignados a ese rol.
     *
     * @param int $rolId El ID del rol del cual se desean mostrar los privilegios faltantes.
     * @return \Illuminate\Http\Response
     */

    public function ObtenerModulosConSubmodulosFaltantes($IdRol)
    {
        $modulos = DB::table('modulos as m')
            ->leftJoin('submodulos as sm', 'm.id', '=', 'sm.modulos_id')
            ->whereNotIn('sm.id', function ($query) use ($IdRol) { // Aquí se pasa el parámetro $IdRol usando "use"
                $query->select('pu.submodulos_id')
                    ->from('privilegiosroles as pu')
                    ->where('pu.roles_id', $IdRol); // Aquí se utiliza el parámetro $IdRol
            })
            ->select('m.id as modulo_id', 'm.nombre as modulo_nombre', 'sm.id as submodulo_id', 'sm.nombre as submodulo_nombre')
            ->get();
        $modulosArray = [];
        foreach ($modulos as $modulo) {
            $modulo_id = $modulo->modulo_id;
            $submodulo_id = $modulo->submodulo_id;

            if (!isset($modulosArray[$modulo_id])) {
                $modulosArray[$modulo_id] = [
                    'id' => $modulo_id,
                    'nombre' => $modulo->modulo_nombre,
                    'submodulos' => [],
                ];
            }

            if (!empty($submodulo_id)) {
                $modulosArray[$modulo_id]['submodulos'][] = [
                    'id' => $submodulo_id,
                    'nombre' => $modulo->submodulo_nombre,
                ];
            }
        }
        // Ordenar el arreglo por la cantidad de submódulos
        usort($modulosArray, function ($a, $b) {
            return count($a['submodulos']) - count($b['submodulos']);
        });

        return $modulosArray;
    }
}
