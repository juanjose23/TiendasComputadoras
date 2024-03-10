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
            'Televisores',
            'Smartphones',
            'Laptops',
            'Tabletas',
            'Cámaras digitales',
            'Auriculares',
            'Altavoces',
            'Videojuegos',
            'Accesorios de computadora',
            'Dispositivos de almacenamiento'
        ];

        foreach ($categorias as $categoria) {
            Categorias::create([
                'nombre' => $categoria,
                'descripcion' => 'Productos electrónicos de la categoría ' . $categoria,
                'estado' => 1
            ]);
        }
    }
}
