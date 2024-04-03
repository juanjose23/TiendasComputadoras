<?php

namespace Database\Seeders;

use App\Models\Cortes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CortesSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $cortes = [
            ['nombre' => 'Regular', 'descripcion' => 'Corte estándar para un ajuste cómodo.','estado'=>1],
            ['nombre' => 'Slim Fit', 'descripcion' => 'Corte ajustado para un aspecto más entallado.','estado'=>1],
            ['nombre' => 'Skinny', 'descripcion' => 'Corte muy ajustado para un aspecto ceñido al cuerpo.','estado'=>1],
            ['nombre' => 'Bootcut', 'descripcion' => 'Corte ligeramente ajustado en la parte superior y ensanchado hacia los tobillos.','estado'=>1],
            ['nombre' => 'Straight', 'descripcion' => 'Corte recto y uniforme desde la cadera hasta el tobillo.','estado'=>1],
            ['nombre' => 'Relaxed Fit', 'descripcion' => 'Corte suelto y cómodo para un aspecto relajado.','estado'=>1],
            ['nombre' => 'Flare', 'descripcion' => 'Corte ajustado en la cintura y amplio en la parte inferior.','estado'=>1],
            ['nombre' => 'Tapered', 'descripcion' => 'Corte que se estrecha gradualmente hacia los tobillos.','estado'=>1],
            ['nombre' => 'Athletic Fit', 'descripcion' => 'Corte ajustado para una apariencia atlética y musculosa.','estado'=>1],
            ['nombre' => 'Baggy', 'descripcion' => 'Corte holgado y amplio para un aspecto informal y cómodo.','estado'=>1],
        ];

        foreach ($cortes as $corte) {
            Cortes::create($corte);
        }
    }
}
