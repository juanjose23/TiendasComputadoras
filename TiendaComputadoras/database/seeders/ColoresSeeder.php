<?php

namespace Database\Seeders;

use App\Models\Colores;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $colores = [
            ['nombre' => 'Rojo', 'codigo' => '#FF0000', 'estado' => 1],
            ['nombre' => 'Verde', 'codigo' => '#00FF00', 'estado' => 1],
            ['nombre' => 'Azul', 'codigo' => '#0000FF', 'estado' => 1],
            ['nombre' => 'Amarillo', 'codigo' => '#FFFF00', 'estado' => 1],
            ['nombre' => 'Naranja', 'codigo' => '#FFA500', 'estado' => 1],
            ['nombre' => 'Blanco', 'codigo' => '#FFFFFF', 'estado' => 1],
            ['nombre' => 'Negro', 'codigo' => '#000000', 'estado' => 1],
            ['nombre' => 'Gris', 'codigo' => '#808080', 'estado' => 1],
            ['nombre' => 'Morado', 'codigo' => '#800080', 'estado' => 1],
            ['nombre' => 'Rosa', 'codigo' => '#FFC0CB', 'estado' => 1],
        ];

        foreach ($colores as $color) {
            Colores::create($color);
        }
    }
}
