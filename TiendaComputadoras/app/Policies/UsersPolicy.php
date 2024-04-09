<?php

namespace App\Policies;

use App\Models\permisosroles;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class UsersPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
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
            echo "Tengo permisos";
            exit();
            return true;
        }

        echo "No tengos permisos";
        exit();
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
        var_dump($permisos);
        // ID del permiso necesario para crear cargos

        // Verifica si el usuario tiene el permiso deseado
        foreach ($permisos as $permiso) {
            var_dump($permiso);
           
            if ($permiso->permisosmodulos_id === $idPermisoDeseado) {
                echo "Tengo permisos";
                exit();
                return true;
            }
        }

        echo "No tengo permiso";
        exit();
        return false;
    }
}
