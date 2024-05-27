<?php

namespace Database\Seeders;

use App\Models\Persona_Naturales;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class personanaturalseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $personas = [

            [
                'personas_id' => 2,
                'paises_id' => 168,
                'generos_id' => 2,
                'apellido' => 'Rios Huete',
                'tipo_identificacion' => 'Cedula',
                'identificacion' => '001-160402-1039W',
                'fecha_nacimiento' => '2002-04-16'
            ],
            [
                'personas_id' => 3,
                'paises_id' => 168,
                'generos_id' => 2,
                'apellido' => 'Varela',
                'tipo_identificacion' => 'Cedula',
                'identificacion' => '001-161023-1078W',
                'fecha_nacimiento' => '2002-10-16'
            ],
            [
                'personas_id' => 4,
                'paises_id' => 168,
                'generos_id' => 1,
                'apellido' => 'Guillen Davila',
                'tipo_identificacion' => 'Cedula',
                'identificacion' => '001-180403-0403W',
                'fecha_nacimiento' => '2003-04-18'
            ],
            [
                'personas_id' => 5,
                'paises_id' => 168,
                'generos_id' => 1,
                'apellido' => 'Torrez',
                'tipo_identificacion' => 'Cedula',
                'identificacion' => '001-170103-0403W',
                'fecha_nacimiento' => '2003-04-17'
            ],
            [
                'personas_id' => 6,
                'paises_id' => 168,
                'generos_id' => 2,
                'apellido' => 'Lopez',
                'tipo_identificacion' => 'Cedula',
                'identificacion' => '001-480502-0403W',
                'fecha_nacimiento' => '2002-05-01'
            ]




        ];

        // Crear los modelos utilizando el array
        foreach ($personas as $persona) {
            Persona_Naturales::create($persona);
        }
    }
}
