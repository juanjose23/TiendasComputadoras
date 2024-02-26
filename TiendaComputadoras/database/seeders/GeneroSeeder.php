<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genero;
class GeneroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $generos = [
            ['nombre' => 'Femenino', 'estado' => 1],
            ['nombre' => 'Masculino', 'estado' => 1],
            ['nombre' => 'No Binario', 'estado' => 1],
            ['nombre' => 'Género Fluido', 'estado' => 1],
            ['nombre' => 'Agénero', 'estado' => 1],
            ['nombre' => 'Bigénero', 'estado' => 1],
            ['nombre' => 'Dos Espíritus', 'estado' => 1],
            ['nombre' => 'Géneroqueer', 'estado' => 1],
            ['nombre' => 'Pangénero', 'estado' => 1],
            [ 'nombre' => 'Tercer Género', 'estado' => 1],
            [ 'nombre' => 'Andrógino', 'estado' => 1],
            [ 'nombre' => 'Neutrois', 'estado' => 1],
            [ 'nombre' => 'Demigénero', 'estado' => 1],
            [ 'nombre' => 'Femme', 'estado' => 1],
            [ 'nombre' => 'Butch', 'estado' => 1],
            [ 'nombre' => 'Transexual', 'estado' => 1],
            [ 'nombre' => 'Cisgénero', 'estado' => 1],
            [ 'nombre' => 'Intersexual', 'estado' => 1],
            [ 'nombre' => 'Otro', 'estado' => 1],
        ];
        foreach($generos as $genero)
        {
            Genero::create($genero);
        }
    }
}
