<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Direcciones;

class DireccionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $direcciones = [
            [
                'municipios_id' =>85,
                'personas_id'=>1,
                'punto_referencia'=>'',
                'direccion'=>'Direccion',
                'estado' => 1
            ],
            [
                'municipios_id' =>85,
                'personas_id'=>2,
                'punto_referencia'=>'',
                'direccion'=>'De donde fue la farmacia tipitapa 1/2 al sur',
                'estado' => 1
            ],
            [
                'municipios_id' =>93,
                'personas_id'=>3,
                'punto_referencia'=>'',
                'direccion'=>'De la calle de los brujo casa verde donde hay un palo de mango',
                'estado' => 1
            ],
            [
                'municipios_id' =>93,
                'personas_id'=>4,
                'punto_referencia'=>'',
                'direccion'=>'De la calle de los brujo casa verde donde hay un palo de mango al otro lado',
                'estado' => 1
            ],
            [
                'municipios_id' =>84,
                'personas_id'=>5,
                'punto_referencia'=>'',
                'direccion'=>'Donde la vida no vale nada el Zumen',
                'estado' => 1
            ],
            [
                'municipios_id' =>84,
                'personas_id'=>6,
                'punto_referencia'=>'',
                'direccion'=>'Donde la vida no vale nada',
                'estado' => 1
            ],

        ];
        foreach ($direcciones as $direccion) {
            Direcciones::create($direccion);
        }
    }
}
