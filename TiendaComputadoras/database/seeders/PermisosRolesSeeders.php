<?php

namespace Database\Seeders;

use App\Models\permisosroles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermisosRolesSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permisosRoles = [
            ['roles_id' => 2, 'permisosmodulos_id' => 1, 'estado' => 1],
            ['roles_id' => 2, 'permisosmodulos_id' => 2, 'estado' => 1],
            ['roles_id' => 2, 'permisosmodulos_id' => 3, 'estado' => 1],
            ['roles_id' => 2, 'permisosmodulos_id' => 1, 'estado' => 1],
            ['roles_id' => 2, 'permisosmodulos_id' => 2, 'estado' => 1],
            ['roles_id' => 2, 'permisosmodulos_id' => 3, 'estado' => 1],
            ['roles_id' => 2, 'permisosmodulos_id' => 1, 'estado' => 1],
            ['roles_id' => 2, 'permisosmodulos_id' => 2, 'estado' => 1],
            ['roles_id' => 2, 'permisosmodulos_id' => 3, 'estado' => 1],
            ['roles_id' => 2, 'permisosmodulos_id' => 1, 'estado' => 1],
            ['roles_id' => 2, 'permisosmodulos_id' => 2, 'estado' => 1],
            ['roles_id' => 2, 'permisosmodulos_id' => 3, 'estado' => 1],
            ['roles_id' => 2, 'permisosmodulos_id' => 1, 'estado' => 1],
            ['roles_id' => 2, 'permisosmodulos_id' => 2, 'estado' => 1],
            ['roles_id' => 2, 'permisosmodulos_id' => 3, 'estado' => 1],
            ['roles_id' => 2, 'permisosmodulos_id' => 1, 'estado' => 1],
            ['roles_id' => 2, 'permisosmodulos_id' => 2, 'estado' => 1],
            ['roles_id' => 2, 'permisosmodulos_id' => 3, 'estado' => 1],
            ['roles_id' => 2, 'permisosmodulos_id' => 7, 'estado' => 1],
            ['roles_id' => 2, 'permisosmodulos_id' => 1, 'estado' => 1],
            ['roles_id' => 2, 'permisosmodulos_id' => 2, 'estado' => 1],
            ['roles_id' => 2, 'permisosmodulos_id' => 3, 'estado' => 1],
            ['roles_id' => 2, 'permisosmodulos_id' => 4, 'estado' => 1],
            ['roles_id' => 2, 'permisosmodulos_id' => 5, 'estado' => 1],
            ['roles_id' => 2, 'permisosmodulos_id' => 6, 'estado' => 1]

        ];

        // Crear los modelos utilizando el array
        foreach ($permisosRoles as $permiso) {
            permisosroles::create($permiso);
        }
    }
}
