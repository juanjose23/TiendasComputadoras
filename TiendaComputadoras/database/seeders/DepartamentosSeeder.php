<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Departamentos;

class DepartamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $departamentos = [
            ['pais_id' => 168, 'nombre' => 'Boaco', 'cod_postal' => 46000, 'estado' => 1],
            ['pais_id' => 168, 'nombre' => 'Carazo', 'cod_postal' => 47000, 'estado' => 1],
            ['pais_id' => 168, 'nombre' => 'Chinandega', 'cod_postal' => 48000, 'estado' => 1],
            ['pais_id' => 168, 'nombre' => 'Chontales', 'cod_postal' => 49000, 'estado' => 1],
            ['pais_id' => 168, 'nombre' => 'Estelí', 'cod_postal' => 52000, 'estado' => 1],
            ['pais_id' => 168, 'nombre' => 'Granada', 'cod_postal' => 53000, 'estado' => 1],
            ['pais_id' => 168, 'nombre' => 'Jinotega', 'cod_postal' => 54000, 'estado' => 1],
            ['pais_id' => 168, 'nombre' => 'León', 'cod_postal' => 46000, 'estado' => 1],
            ['pais_id' => 168, 'nombre' => 'Madriz', 'cod_postal' => 47000, 'estado' => 1],
            ['pais_id' => 168, 'nombre' => 'Managua', 'cod_postal' => 48000, 'estado' => 1],
            ['pais_id' => 168, 'nombre' => 'Masaya', 'cod_postal' => 49000, 'estado' => 1],
            ['pais_id' => 168, 'nombre' => 'Matagalpa', 'cod_postal' => 52000, 'estado' => 1],
            ['pais_id' => 168, 'nombre' => 'Nueva Segovia', 'cod_postal' => 53000, 'estado' => 1],
            ['pais_id' => 168, 'nombre' => 'Río San Juan', 'cod_postal' => 54000, 'estado' => 1],
            ['pais_id' => 168, 'nombre' => 'Rivas', 'cod_postal' => 46000, 'estado' => 1],
            ['pais_id' => 168, 'nombre' => 'Atlántico Norte', 'cod_postal' => 47000, 'estado' => 1],
            ['pais_id' => 168, 'nombre' => 'Atlántico Sur', 'cod_postal' => 46000, 'estado' => 1],
        ];
        foreach($departamentos as $departamentos)
        {
            Departamentos::create($departamentos);
        }
    }
}
