<?php

namespace Database\Seeders;

use App\Models\Categorias;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            'Camisetas',
            'Pantalones',
            'Chaquetas',
            'Vestidos',
            'Camisas',
            'Faldas',
            'Sweaters',
            'Abrigos',
            'Ropa interior',
            'Trajes de baño'
        ];
        

        foreach ($categorias as $categoria) {
            Categorias::create([
                'nombre' => $categoria,
                'descripcion' => 'Productos de ropas de la categoría ' . $categoria,
                'estado' => 1
            ]);
        }
    }
}
