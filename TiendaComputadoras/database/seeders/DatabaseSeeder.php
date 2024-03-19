<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PaisSeeder::class);
        $this->call(DepartamentosSeeder::class);
        $this->call(MunicipiosSeeder::class);
        $this->call(GeneroSeeder::class);
        $this->call(Estado_CivilesSeeder::class);
        $this->call(ColoresSeeder::class);
        $this->call(MarcasSeeder::class);
        $this->call(ModelosSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(SubcategoriasSeeder::class);
        $this->call(PersonasSeeder::class);
        $this->call(personanaturalseeder::class);
        $this->call(empleadosseeder::class);
        $this->call(DireccionesSeeder::class);
        $this->call(ImagenesSeeders::class);
        $this->call(modulos::class);
        $this->call(submodulos::class);
        $this->call(permisos::class);
        $this->call(permisosmodulos::class);

    }
}
