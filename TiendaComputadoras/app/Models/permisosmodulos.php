<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class permisosmodulos extends Model
{
    use HasFactory;
    public function modulos()
    {
        return $this->belongsTo('App\Models\modulos');
    }
    public function permisosp()
    {
        return $this->belongsTo('App\Models\permisos');
    }

    public function permisosRoles()
    {
        return $this->hasMany('App\Models\permisosroles');
    }

    /**
     * Obtiene los permisos de módulos para un usuario específico.
     *
     * @param int $idUsuario El ID del usuario para el que se obtendrán los permisos.
     * @return array Un array con los ID de permiso y módulo para el usuario.
     */
    public function obtenerPermisosModulos($idUsuario)
    {
        $permisos = [];
        $resultados = DB::table('permisosroles')
            ->select('permisos.id as permiso_id', 'modulos.id as modulo_id')
            ->join('permisosmodulos', 'permisosroles.permisosmodulos_id', '=', 'permisosmodulos.id')
            ->join('modulos', 'permisosmodulos.modulos_id', '=', 'modulos.id')
            ->join('roles', 'permisosroles.roles_id', '=', 'roles.id')
            ->join('rolesusuarios', 'roles.id', '=', 'rolesusuarios.roles_id')
            ->join('users', 'rolesusuarios.users_id', '=', 'users.id')
            ->where('users.id', '=', $idUsuario)
            ->get();

        foreach ($resultados as $fila) {
            $permisos[] = [
                'id_permiso' => $fila->permiso_id,
                'id_modulo' => $fila->modulo_id
            ];
        }

        // Retornar el arreglo con los ID de permiso y módulo
        return $permisos;
    }
}
