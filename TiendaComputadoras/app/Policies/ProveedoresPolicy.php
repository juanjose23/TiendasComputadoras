<?php

namespace App\Policies;

use App\Models\permisosroles;
use App\Models\Proveedores;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProveedoresPolicy
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
    public function view(User $user, Proveedores $proveedores): bool
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
        $idPermisoDeseado = 4;
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
        $idPermisoDeseado = 5;
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
        $idPermisoDeseado = 6;
        if ($this->tienePermiso($user, $idPermisoDeseado)) {

            return true;
        }


        return false;
    }

    private function tienePermiso(User $user, $idPermisoDeseado): bool
    {
        $userId = $user->id;
        $permisos = permisosroles::obtenerPermisosRoles($userId); // Aquí deberías llamar a tu función para obtener los permisos del usuario

        // ID del permiso necesario para crear cargos

        // Verifica si el usuario tiene el permiso deseado
        foreach ($permisos as $permiso) {

            if ($permiso->id === $idPermisoDeseado) {

                return true;
            }
        }

        return false;
    }
}
