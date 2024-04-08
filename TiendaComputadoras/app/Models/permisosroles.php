<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class permisosroles extends Model
{
    use HasFactory;
    public function  permisosmodulos()
    {
        return  $this->belongsTo('App\Models\permisosmodulos');
    }

    public function roles()
    {
        return $this->belongsTo('App\Models\RolesModel');
    }
    /**
     * Obtiene los permisos asociados a los módulos.
     *
     * @return array Lista de módulos con sus respectivos permisos.
     */
    /**
     * Obtiene los permisos asociados a los módulos y los ordena por la cantidad de submódulos.
     *
     * @return array Lista de módulos con sus respectivos permisos, ordenados por cantidad de submódulos.
     */
    public static function obtenerPermisosModulos()
    {
        // Realizar la consulta para obtener los permisos asociados a los módulos activos
        $permisos = DB::table('modulos as m')
            ->join('permisosmodulos as pm', 'pm.modulos_id', '=', 'm.id')
            ->join('permisos as p', 'p.id',  '=', 'pm.permisos_id')
            ->select('pm.id as id_permiso_modulo', 'm.id as id_modulo', 'm.nombre as nombre_modulo', 'p.id as id_permiso', 'p.nombre as nombre_permiso')
            ->where('m.estado', '=', 1)
            ->get();

        // Verificar si se obtuvieron resultados
        if ($permisos->isNotEmpty()) {
            // Agrupar los permisos por módulo
            $modulosConPermisos = $permisos->groupBy('nombre_modulo')->map(function ($items) {
                $permisos = $items->map(function ($item) {
                    return [
                        'id_permiso_modulo' => $item->id_permiso_modulo,
                        'id' => $item->id_permiso,
                        'nombre' => $item->nombre_permiso
                    ];
                })->toArray();

                return [
                    'id' => $items->first()->id_modulo,
                    'nombre' => $items->first()->nombre_modulo,
                    'permisos' => $permisos,
                    'cantidad_submodulos' => count($permisos) // Agregar la cantidad de submódulos al arreglo de cada módulo
                ];
            })->values()->toArray();

            // Ordenar los resultados por la cantidad de submódulos
            usort($modulosConPermisos, function ($a, $b) {
                return $a['cantidad_submodulos'] - $b['cantidad_submodulos'];
            });

            return $modulosConPermisos;
        } else {
            return [];
        }
    }

    /**
     * Obtener los permisos faltantes para un rol específico.
     *
     * Esta función obtiene los permisos que están asociados a módulos activos pero que no están asignados
     * al rol especificado.
     *
     * @param int $IdRol El ID del rol del que se desean obtener los permisos faltantes.
     * @return array Un array que contiene los módulos con sus permisos faltantes.
     */
    public function obtenerpermisosfaltantes($IdRol)
    {

        $resultados = DB::table('modulos as m')
            ->select('pm.id as id_permiso_modulo', 'm.id as id_modulo', 'm.nombre as nombre_modulo', 'p.id as id_permiso', 'p.nombre as nombre_permiso')
            ->join('permisosmodulos as pm', 'm.id', '=', 'pm.modulos_id')
            ->join('permisos as p', 'pm.permisos_id', '=', 'p.id')
            ->where('m.estado', '=', 1)
            ->whereNotIn('pm.id', function ($query) use ($IdRol) {
                $query->select('pp.permisosmodulos_id')
                    ->from('permisosroles as pp')
                    ->where('pp.roles_id', '=', $IdRol);
            })
            ->get();


        $permisos = [];

        foreach ($resultados as $resultado) {
            $modulo_nombre = $resultado->nombre_modulo;
            $permiso = [
                'id_permiso_modulo' => $resultado->id_permiso_modulo,
                'id' => $resultado->id_permiso,
                'nombre' => $resultado->nombre_permiso
            ];
            if (array_key_exists($modulo_nombre, $permisos)) {
                $permisos[$modulo_nombre]['permisos'][] = $permiso;
            } else {
                $permisos[$modulo_nombre] = [
                    'id' => $resultado->id_modulo,
                    'nombre' => $modulo_nombre,
                    'permisos' => [$permiso]
                ];
            }
        }
        return array_values($permisos);
    }

    /**
     * Mostrar los permisos asignados a un rol.
     *
     * Esta función obtiene los permisos asignados a un rol específico y los organiza por módulos.
     *
     * @param int $IdRol El ID del rol del cual se desean mostrar los permisos asignados.
     * @return array Arreglo de permisos organizados por módulos.
     */
    public function mostrarpermisosrol($IdRol)
    {
        $resultados = DB::table('permisosroles as pp')
            ->select('pp.id as id_permiso_modulo', 'm.id as id_modulo', 'm.nombre as nombre_modulo', 'p.id as id_permiso', 'p.nombre as nombre_permiso', 'pp.created_at AS fecha_registro', 'pp.updated_at AS fecha_actualizacion')
            ->leftJoin('permisosmodulos as pm', 'pp.permisosmodulos_id', '=', 'pm.id')
            ->leftJoin('modulos as m', 'm.id', '=', 'pm.modulos_id')
            ->leftJoin('permisos as p', 'p.id', '=', 'pm.permisos_id')
            ->where('pp.roles_id', '=', $IdRol)
            ->orderBy('id_permiso_modulo')
            ->orderBy('id_modulo')
            ->orderBy('id_permiso')
            ->get();
        $permisos = [];
        foreach ($resultados as $resultado) {
            $modulo_nombre = $resultado->nombre_modulo;
            $permiso = [
                'id_permiso_modulo' => $resultado->id_permiso_modulo,
                'id' => $resultado->id_permiso,
                'nombre' => $resultado->nombre_permiso,
                'fecha_registro' => $resultado->fecha_registro,
                'fecha_actualizacion' => $resultado->fecha_actualizacion

            ];
            if (array_key_exists($modulo_nombre, $permisos)) {
                $permisos[$modulo_nombre]['permisos'][] = $permiso;
            } else {
                $permisos[$modulo_nombre] = [
                    'id' => $resultado->id_modulo,
                    'nombre' => $modulo_nombre,
                    'permisos' => [$permiso],
                    'fecha_registro' => $resultado->fecha_registro,
                    'fecha_actualizacion' => $resultado->fecha_actualizacion
                ];
            }
        }
        // Devolver los permisos organizados por módulos
        return array_values($permisos);
    }

    /**
     * Función para obtener los permisos de roles para un usuario específico
     *
     * @param int $userId ID del usuario
     * @return array Array de resultados de permisos de roles
     */
    public static function obtenerPermisosRoles($userId)
    {
        // Realizar la consulta utilizando el Query Builder de Laravel
        $resultados = DB::table('permisosroles AS pr')
            ->select('pr.permisosmodulos_id', 'pr.id')
            ->join('rolesusuarios AS ru', 'ru.roles_id', '=', 'pr.roles_id')
            ->join('users AS u', 'u.id', '=', 'ru.users_id')
            ->where('u.id', $userId)
            ->get();

        // Devolver los resultados como un array
        return $resultados->toArray();
    }
}
