<?php

namespace Database\Seeders;

use App\Models\Estado_civiles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Estado_civilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $estadosCiviles = [
            ['nombre' => 'Soltero(a)'],
            ['nombre' => 'Casado(a)'],
            ['nombre' => 'Viudo(a)'],
            ['nombre' => 'Divorciado(a)'],
            ['nombre' => 'Separado(a)']
        ];
        foreach( $estadosCiviles as $estadosCiviles) {
            Estado_civiles::create($estadosCiviles);
        }
    }
}
