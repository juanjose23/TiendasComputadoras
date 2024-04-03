<?php

namespace Database\Seeders;

use App\Models\RolesUsuarios;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesUsuariosSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $roles = [
            [
                'roles_id' => 2,
                'users_id' => 1,
                'estado' => 1
            ],

        ];
        foreach ($roles as $rol) {
            RolesUsuarios::create($rol);
        }
    }
}
