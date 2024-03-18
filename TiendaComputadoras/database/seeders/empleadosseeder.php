<?php

namespace Database\Seeders;

use App\Models\Empleados;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class empleadosseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $personas = [
            [
                'personas_id'=>1,
                'estado_civiles_id'=>1,
                'codigo'=>'EMP-01',
                'codigo_inss' => null,
                'estado'=>1
            ],
            [
                'personas_id'=>2,
                'estado_civiles_id'=>1,
                'codigo'=>'EMP-02',
                'codigo_inss' => null,
                'estado'=>1
            ],
            [
                'personas_id'=>3,
                'estado_civiles_id'=>1,
                'codigo'=>'EMP-03',
                'codigo_inss' =>null,
                'estado'=>1
            ],
            [
                'personas_id'=>4,
                'estado_civiles_id'=>1,
                'codigo'=>'EMP-04',
                'codigo_inss' => null,
                'estado'=>1
            ],
            [
                'personas_id'=>5,
                'estado_civiles_id'=>1,
                'codigo'=>'EMP-05',
                'codigo_inss' => null,
                'estado'=>1
            ]
           
        ];

        // Crear los modelos utilizando el array
        foreach ($personas as $persona) {
            Empleados::create($persona);
        }
    }
}
