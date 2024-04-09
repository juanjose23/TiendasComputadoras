<?php

namespace App\Policies;

use App\Models\permisos;
use App\Models\permisosroles;
use App\Models\User;
use App\Models\RolesUsuarios;

class PermisosPolicy
{
    /**
     * Create a new policy instance.
     */
   
    public function viewAny(User $user): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, permisos $model): bool
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
        $idPermisoDeseado = 24;
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
        $idPermisoDeseado = 23;
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
        $idPermisoDeseado = 24;
        if ($this->tienePermiso($user, $idPermisoDeseado)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user): bool
    {
        //
        $idPermisoDeseado = 24;
        if ($this->tienePermiso($user, $idPermisoDeseado)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user): bool
    {
        //
        $idPermisoDeseado = 24;
        if ($this->tienePermiso($user, $idPermisoDeseado)) {
            return true;
        }

        return false;
    }
    private function tienePermiso(User $user, $idPermisoDeseado): bool
    {
        $userId = $user->id;
        $permisos = permisosroles::obtenerPermisosRoles($userId); // Aquí deberías llamar a tu función para obtener los permisos del usuario
       
        foreach ($permisos as $permiso) {
         
           
            if ($permiso->permisosmodulos_id === $idPermisoDeseado) {
             
                return true;
            }
        }

       
        return false;
    }
}
