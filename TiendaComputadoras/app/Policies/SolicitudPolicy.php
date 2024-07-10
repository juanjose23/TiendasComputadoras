<?php

namespace App\Policies;

use App\Models\permisosroles;
use App\Models\Solicitud_compra;
use App\Models\User;

class SolicitudPolicy
{
    public function viewAny(User $user): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Solicitud_compra $solicitud): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        $idPermisoDeseado = 7;
        if ($this->tienePermiso($user, $idPermisoDeseado)) {

          return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        //
        $idPermisoDeseado = 8;
        if ($this->tienePermiso($user, $idPermisoDeseado)) {

            return true;
        }


        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        //
        $idPermisoDeseado = 9;
        if ($this->tienePermiso($user, $idPermisoDeseado)) {

            return true;
        }


        return false;
    }
    public function restore(User $user): bool
    {
        //
        $idPermisoDeseado = 20;
        if ($this->tienePermiso($user, $idPermisoDeseado)) {

            return true;
        }


        return false;
    }

    private function tienePermiso(User $user, $idPermisoDeseado): bool
    {
        $userId = $user->id;
        $permisos = permisosroles::obtenerPermisosRoles($userId);
        $userId = $user->id;
        $permisos = permisosroles::obtenerPermisosRoles($userId); // Aquí deberías llamar a tu función para obtener los permisos del usuario

       
        return collect($permisos)->contains('permisosmodulos_id', $idPermisoDeseado);
    }
}
