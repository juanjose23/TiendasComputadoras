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
     * Obtener los módulos y submódulos faltantes para un rol dado.
     *
     * Esta función recibe el ID de un rol y devuelve los módulos y submódulos
     * que no están asignados a ese rol.
     *
     * @param int $rolId El ID del rol del cual se desean obtener los privilegios faltantes.
     * @return array Un arreglo con los módulos y submódulos faltantes.
     */
    public function obtenerModulosConSubmodulosFaltantes($rolId)
    {
        $modulosFaltantes = DB::table('modulos as m')
            ->leftJoin('submodulos as sm', 'm.id', '=', 'sm.modulos_id')
            ->whereNotIn('sm.id', function ($query) use ($rolId) {
                $query->select('pu.submodulos_id')
                    ->from('privilegiosroles as pu')
                    ->where('pu.roles_id', $rolId);
            })
            ->select('m.id as modulo_id', 'm.nombre as modulo_nombre', 'sm.id as submodulo_id', 'sm.nombre as submodulo_nombre')
            ->get();

        $modulosArray = [];
        foreach ($modulosFaltantes as $modulo) {
            $moduloId = $modulo->modulo_id;
            $submoduloId = $modulo->submodulo_id;

            if (!isset($modulosArray[$moduloId])) {
                $modulosArray[$moduloId] = [
                    'id' => $moduloId,
                    'nombre' => $modulo->modulo_nombre,
                    'submodulos' => [],
                ];
            }

            if (!empty($submoduloId)) {
                $modulosArray[$moduloId]['submodulos'][] = [
                    'id' => $submoduloId,
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

    /**
     * Obtener los privilegios de acceso de un rol.
     *
     * Esta función recibe el ID de un rol y devuelve los privilegios de acceso
     * asociados a ese rol.
     *
     * @param int $rolId El ID del rol del cual se desean obtener los privilegios.
     * @return array Un arreglo con los privilegios de acceso del rol.
     */
    public function obtenerPrivilegiosRol($rolId)
    {
        $privilegios = DB::table('privilegiosroles as pu')
            ->join('submodulos as sm', 'pu.submodulos_id', '=', 'sm.id')
            ->leftJoin('modulos as m', 'sm.modulos_id', '=', 'm.id')
            ->where('pu.roles_id', $rolId)
            ->select(
                'pu.id as privilegio_id',
                'm.id as modulo_id',
                'm.nombre as modulo_nombre',
                'sm.id as submodulo_id',
                'sm.nombre as submodulo_nombre',
                'pu.created_at',
                'pu.updated_at'
            )
            ->orderBy('privilegio_id')
            ->orderBy('modulo_id')
            ->orderBy('submodulo_id')
            ->get();

        $privilegiosArray = [];
        foreach ($privilegios as $privilegio) {
            $moduloId = $privilegio->modulo_id;
            $submoduloId = $privilegio->privilegio_id;
            $fechaRegistro = $privilegio->created_at;
            $fechaActualizacion = $privilegio->updated_at;

            if (!isset($privilegiosArray[$moduloId])) {
                $privilegiosArray[$moduloId] = [
                    'id' => $moduloId,
                    'nombre' => $privilegio->modulo_nombre,
                    'submodulos' => [],
                ];
            }

            if (!empty($submoduloId)) {
                $privilegiosArray[$moduloId]['submodulos'][] = [
                    'id' => $submoduloId,
                    'nombre' => $privilegio->submodulo_nombre,
                    'fecha_registro' => $fechaRegistro,
                    'fecha_actualizacion' => $fechaActualizacion,
                ];
            }
        }

        // Ordenar el arreglo por la cantidad de submódulos
        usort($privilegiosArray, function ($a, $b) {
            return count($a['submodulos']) - count($b['submodulos']);
        });

        return $privilegiosArray;
    }


    /**
     * Obtener privilegios 
     */

    /**
     * Obtener los privilegios de un usuario por su ID.
     *
     * @param  int  $id  El ID del usuario.
     * @return array     Los privilegios del usuario.
     */
    public function ObtenerPrivilegiosUsuario($id)
    {
        // Realizar la consulta para obtener los privilegios del usuario
        $resultado = db::table('privilegiosroles  as pr')
            ->select('pr.submodulos_id', 'm.id AS id_modulo', 'm.nombre AS modulo', 'm.icono', 'sm.nombre AS submodulo', 'sm.enlace', 'rt.roles_id AS id_rol_temporal')
            ->join('submodulos AS sm', 'sm.id', '=', 'pr.submodulos_id')
            ->join('modulos AS m', 'm.id', '=', 'sm.modulos_id')
            ->leftJoin('rolesusuarios AS rt', 'rt.roles_id', '=', 'pr.roles_id')
            ->leftJoin('users AS u', 'rt.users_id', '=', 'u.id')
            ->where('rt.users_id', '=', $id)
            ->where('rt.estado', '=', 1)
            ->get();

        // Inicializar un arreglo para almacenar los modulos y submodulos
        $modulos = array();
        foreach ($resultado as $row) {
            $modulo_id = $row->id_modulo;
            $submodulo_id = $row->submodulos_id;

            // Verificar si el modulo ya existe en el arreglo, sino agregarlo
            if (!isset($modulos[$modulo_id])) {
                $modulos[$modulo_id] = array(
                    'id' => $modulo_id,
                    'nombre' => $row->modulo,
                    'icono' => $row->icono,
                    'submodulos' => array()
                );
            }

            // Verificar si el submodulo no está vacío, si no está vacío agregarlo al modulo correspondiente
            if (!empty($submodulo_id)) {
                $submodulo = array(
                    'id' => $submodulo_id,
                    'nombre' => $row->submodulo,
                    'enlace' => $row->enlace
                );
                $modulos[$modulo_id]['submodulos'][] = $submodulo;
            }
        }


        // Retornar los privilegios estructurados
        return $modulos;
    }
}
