<?php

namespace Database\Seeders;

use App\Models\RolesUsuarios;
use App\Models\Tallas;
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
        $this->call(TallasSeeders::class);
        $this->call(CortesSeeders::class);
        $this->call(PersonasSeeder::class);
        $this->call(personanaturalseeder::class);
        $this->call(empleadosseeder::class);
        $this->call(DireccionesSeeder::class);
        $this->call(ImagenesSeeders::class);
        $this->call(modulos::class);
        $this->call(submodulos::class);
        $this->call(permisos::class);
        $this->call(permisosmodulos::class);
        $this->call(RolesSeeder::class);
        $this->call(PrivilegiosSeeders::class);
        $this->call(PermisosRolesSeeders::class);
        $this->call(UsuariosSeeders::class);
        $this->call(RolesUsuariosSeeders::class);
    }
}
