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
}
