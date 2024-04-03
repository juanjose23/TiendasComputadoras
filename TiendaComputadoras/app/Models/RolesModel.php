<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolesModel extends Model 
{
    protected $table = 'roles';
    use HasFactory;

    public function privilegios()
    {
        return $this->hasMany('App\Models\Privilegios');
    }

    public function permisos()
    {
        return $this->hasMany('App\Models\permisosroles');
    }
    public function rolesusuarios()
    {
        return $this->hasMany(RolesUsuarios::class, 'roles_id');
    }
    /**
     * Obtiene los roles que no tienen privilegios asociados.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function obtenerRolesSinPrivilegios()
    {

        $roles = RolesModel::where('estado', 1)
            ->whereNotIn('id', [1]) // Excluir el rol con ID 1 
            ->whereNotIn('id', function ($query) {
                // Subconsulta para excluir roles con privilegios asociados
                $query->select('roles_id')->from('privilegiosroles');
            })->get();

        return $roles;
    }
    /**
     * Obtiene los roles que no tienen permisos asociados.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function obtenerRolesSinPermisos()
    {

        $roles = RolesModel::where('estado', 1)
            ->whereNotIn('id', [1]) // Excluir el rol con ID 1 
            ->whereNotIn('id', function ($query) {
                // Subconsulta para excluir roles con privilegios asociados
                $query->select('roles_id')->from('permisosroles');
            })->get();

        return $roles;
    }

    /**
     * Selecciona los roles disponibles, excluyendo aquellos con un ID de 1 en la tabla de roles
     * y aquellos asociados a la tabla rolesusuarios con un roles_id de 2.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\App\Models\RolesModel[]
     */
    public function SelectRoles()
    {
        $roles = RolesModel::where('estado', 1)
            ->whereNotIn('id', function ($query) {
                $query->select('roles_id')
                    ->from('rolesusuarios')
                    ->where('roles_id', 2);
            })
            ->get();
        return $roles;
    }

    /**
     * Obtener los roles disponibles para asignar a un usuario.
     *
     * @param int $id El ID del usuario para el cual se buscan roles disponibles.
     * @return \Illuminate\Database\Eloquent\Collection Colección de roles disponibles.
     */
    public function obtenerRolesDisponiblesParaUsuario($id)
    {
        // Consultar los roles disponibles
        $roles = RolesModel::where('estado', 1)->whereNotIn('id', [1])
            ->whereNotIn('id', function ($query) {
                $query->select('roles_id')
                    ->from('rolesusuarios')
                    ->where('roles_id', 2);
            })
            // Filtrar los roles que no están asignados al usuario
            ->whereNotIn('id', function ($query) use ($id) {
                $query->select('roles_id')
                    ->from('rolesusuarios')
                    ->where('users_id', $id);
            })
            ->get();

        // Devolver los roles disponibles
        return $roles;
    }
}
