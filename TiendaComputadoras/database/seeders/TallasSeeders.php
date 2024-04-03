<?php

namespace Database\Seeders;

use App\Models\Tallas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TallasSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $tallas = [
            ['nombre' => 'XS', 'descripcion' => 'Extra pequeña','estado'=>1],
            ['nombre' => 'S', 'descripcion' => 'Pequeña','estado'=>1],
            ['nombre' => 'M', 'descripcion' => 'Mediana','estado'=>1],
            ['nombre' => 'L', 'descripcion' => 'Grande','estado'=>1],
            ['nombre' => 'XL', 'descripcion' => 'Extra grande','estado'=>1],
            ['nombre' => 'XXL', 'descripcion' => 'Extra extra grande','estado'=>1],
            ['nombre' => '3XL', 'descripcion' => 'Triple extra grande','estado'=>1],
            ['nombre' => '4XL', 'descripcion' => 'Cuádruple extra grande','estado'=>1],
            ['nombre' => '5XL', 'descripcion' => 'Quíntuple extra grande','estado'=>1],
            ['nombre' => '6XL', 'descripcion' => 'Sextuple extra grande','estado'=>1],
        ];

        foreach ($tallas as $talla) {
            Tallas::create($talla);
        }
    }
}
