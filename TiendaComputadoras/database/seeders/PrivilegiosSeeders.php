<?php

namespace Database\Seeders;

use App\Models\Privilegios;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrivilegiosSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asignacion de privielgios a roles de usuarios administradores
        $privilegios = [
            [
                "roles_id" => 2,
                "submodulos_id" => 1,
                "estado" => 1

            ],
            [
                "roles_id" => 2,
                "submodulos_id" => 2,
                "estado" => 1

            ],
            [
                "roles_id" => 2,
                "submodulos_id" => 3,
                "estado" => 1

            ],
            [
                "roles_id" => 2,
                "submodulos_id" => 4,
                "estado" => 1

            ],
            [
                "roles_id" => 2,
                "submodulos_id" => 5,
                "estado" => 1

            ],
            [
                "roles_id" => 2,
                "submodulos_id" => 6,
                "estado" => 1

            ],
            [
                "roles_id" => 2,
                "submodulos_id" => 7,
                "estado" => 1

            ],
            [
                "roles_id" => 2,
                "submodulos_id" => 8,
                "estado" => 1

            ],
            [
                "roles_id" => 2,
                "submodulos_id" => 9,
                "estado" => 1

            ],
            [
                "roles_id" => 2,
                "submodulos_id" => 10,
                "estado" => 1

            ],
            [
                "roles_id" => 2,
                "submodulos_id" => 11,
                "estado" => 1

            ],
            [
                "roles_id" => 2,
                "submodulos_id" => 12,
                "estado" => 1

            ],
            [
                "roles_id" => 2,
                "submodulos_id" => 13,
                "estado" => 1

            ],
            [
                "roles_id" => 2,
                "submodulos_id" => 14,
                "estado" => 1

            ], 
            [
                "roles_id" => 2,
                "submodulos_id" => 15,
                "estado" => 1

            ], 
            [
                "roles_id" => 2,
                "submodulos_id" => 16,
                "estado" => 1

            ], [
                "roles_id" => 2,
                "submodulos_id" => 17,
                "estado" => 1

            ], [
                "roles_id" => 2,
                "submodulos_id" => 18,
                "estado" => 1

            ], [
                "roles_id" => 2,
                "submodulos_id" => 19,
                "estado" => 1

            ], [
                "roles_id" => 2,
                "submodulos_id" => 20,
                "estado" => 1

            ], [
                "roles_id" => 2,
                "submodulos_id" => 21,
                "estado" => 1

            ], [
                "roles_id" => 2,
                "submodulos_id" => 22,
                "estado" => 1

            ], [
                "roles_id" => 2,
                "submodulos_id" => 23,
                "estado" => 1

            ], [
                "roles_id" => 2,
                "submodulos_id" => 24,
                "estado" => 1

            ], [
                "roles_id" => 2,
                "submodulos_id" => 25,
                "estado" => 1

            ],
            [
                "roles_id" => 2,
                "submodulos_id" => 26,
                "estado" => 1

            ],
            [
                "roles_id" => 2,
                "submodulos_id" => 27,
                "estado" => 1

            ],
            [
                "roles_id" => 2,
                "submodulos_id" => 28,
                "estado" => 1

            ],
            [
                "roles_id" => 2,
                "submodulos_id" => 29,
                "estado" => 1

            ],
            [
                "roles_id" => 2,
                "submodulos_id" => 30,
                "estado" => 1

            ],
            [
                "roles_id" => 2,
                "submodulos_id" => 31,
                "estado" => 1

            ],
            [
                "roles_id" => 2,
                "submodulos_id" => 32,
                "estado" => 1

            ],
            [
                "roles_id" => 2,
                "submodulos_id" => 33,
                "estado" => 1

            ],
            [
                "roles_id" => 2,
                "submodulos_id" => 34,
                "estado" => 1

            ],
            [
                "roles_id" => 2,
                "submodulos_id" => 35,
                "estado" => 1

            ]

        ];
        foreach ($privilegios as $privilegio) {
            Privilegios::Create($privilegio);
        }
    }
}
