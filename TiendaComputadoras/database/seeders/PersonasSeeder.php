<?php

namespace Database\Seeders;

use App\Models\Personas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $personas = [
            [
                'nombre' => 'Juan José',
                'correo' => 'juanhuete052@gmail.com',
                'telefono'=>'76668163'
               
            ],
            [
                'nombre' => 'Jhon Enmanuel',
                'correo' => 'jhon@gmail.com',
                'telefono'=>'81277971'
               
            ],
            [
                'nombre' => 'Yassira Lucia',
                'correo' => 'yassira@gmail.com',
                'telefono'=>'58262087'
               
            ],
            [
                'nombre' => 'Azalia Isabella',
                'correo' => 'azalia@gmail.com',
                'telefono'=>'75408977'
               
            ],
            [
                'nombre' => 'Kenner',
                'correo' => 'kenner@gmail.com',
                'telefono'=>'88759788'
               
            ],
           
        ];

        // Crear los modelos utilizando el array
        foreach ($personas as $persona) {
            Personas::create($persona);
        }
    }
}
