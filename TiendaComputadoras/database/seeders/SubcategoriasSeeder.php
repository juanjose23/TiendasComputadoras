<?php

namespace Database\Seeders;

use App\Models\Subcategorias;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubcategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $subcategorias = [
            [
                'categorias_id'=>1,
                'nombre' => 'Camisetas de Manga Corta',
                'descripcion' => 'Camisetas con mangas cortas en una variedad de colores y diseños para hombres y mujeres.',
                'estado' => 1
            ],
            [
                'categorias_id'=>1,
                'nombre' => 'Camisetas de Manga Larga',
                'descripcion' => 'Camisetas con mangas largas en una variedad de estilos y materiales para hombres y mujeres.',
                'estado' => 1
            ],
            [
                'categorias_id'=>1,
                'nombre' => 'Camisetas Estampadas',
                'descripcion' => 'Camisetas con estampados gráficos y diseños creativos para hombres y mujeres.',
                'estado' => 1
            ],
            [
                'categorias_id'=>1,
                'nombre' => 'Camisetas Básicas',
                'descripcion' => 'Camisetas lisas y simples en una variedad de colores básicos para hombres y mujeres.',
                'estado' => 1
            ],
            [
                'categorias_id'=>1,
                'nombre' => 'Camisetas de Algodón Orgánico',
                'descripcion' => 'Camisetas fabricadas con algodón orgánico, respetuoso con el medio ambiente y suave al tacto para hombres y mujeres.',
                'estado' => 1
            ],
            [
                'categorias_id'=>2,
                'nombre' => 'Chaquetas de Cuero',
                'descripcion' => 'Chaquetas de cuero genuino en una variedad de estilos, desde clásicas hasta modernas, para hombres y mujeres.',
                'estado' => 1
            ],
            [
                'categorias_id'=>2,
                'nombre' => 'Chaquetas Impermeables',
                'descripcion' => 'Chaquetas impermeables y cortavientos para hombres y mujeres, diseñadas para proteger contra la lluvia y el viento.',
                'estado' => 1
            ],
            [
                'categorias_id'=>2,
                'nombre' => 'Chaquetas de Lana',
                'descripcion' => 'Chaquetas de lana cálidas y elegantes en una variedad de diseños y colores para hombres y mujeres.',
                'estado' => 1
            ],
            [
                'categorias_id'=>3,
                'nombre' => 'Chaquetas de Cuero',
                'descripcion' => 'Chaquetas de cuero genuino en una variedad de estilos, desde clásicas hasta modernas, para hombres y mujeres.',
                'estado' => 1
            ],
            [
                'categorias_id'=>3,
                'nombre' => 'Chaquetas Impermeables',
                'descripcion' => 'Chaquetas impermeables y cortavientos para hombres y mujeres, diseñadas para proteger contra la lluvia y el viento.',
                'estado' => 1
            ],
            [
                'categorias_id'=>3,
                'nombre' => 'Chaquetas de Lana',
                'descripcion' => 'Chaquetas de lana cálidas y elegantes en una variedad de diseños y colores para hombres y mujeres.',
                'estado' => 1
            ],
            [
                'categorias_id'=>4,
                'nombre' => 'Vestidos Casuales',
                'descripcion' => 'Vestidos informales y cómodos para el uso diario en una variedad de estilos y estampados para mujeres.',
                'estado' => 1
            ],
            [
                'categorias_id'=>4,
                'nombre' => 'Vestidos de Noche',
                'descripcion' => 'Vestidos elegantes y sofisticados para ocasiones especiales y eventos formales para mujeres.',
                'estado' => 1
            ],
            [
                'categorias_id'=>4,
                'nombre' => 'Vestidos Estampados Florales',
                'descripcion' => 'Vestidos con estampados florales y primaverales en una variedad de cortes y longitudes para mujeres.',
                'estado' => 1
            ],
            [
                'categorias_id'=>5,
                'nombre' => 'Camisas de Vestir',
                'descripcion' => 'Camisas elegantes y formales para hombres y mujeres, adecuadas para ocasiones profesionales y eventos formales.',
                'estado' => 1
            ],
            [
                'categorias_id'=>5,
                'nombre' => 'Camisas Informales',
                'descripcion' => 'Camisas casuales y cómodas para el uso diario en una variedad de estilos y estampados para hombres y mujeres.',
                'estado' => 1
            ],
            [
                'categorias_id'=>5,
                'nombre' => 'Camisas de Manga Corta',
                'descripcion' => 'Camisas con mangas cortas en una variedad de tejidos y colores para hombres y mujeres.',
                'estado' => 1
            ],
            [
                'categorias_id'=>6,
                'nombre' => 'Faldas Lápiz',
                'descripcion' => 'Faldas ajustadas y elegantes que se ajustan al cuerpo, ideales para ocasiones formales y profesionales para mujeres.',
                'estado' => 1
            ],
            [
                'categorias_id'=>6,
                'nombre' => 'Faldas Plisadas',
                'descripcion' => 'Faldas con pliegues y detalles plisados que añaden volumen y movimiento, disponibles en una variedad de longitudes para mujeres.',
                'estado' => 1
            ],
            [
                'categorias_id'=>6,
                'nombre' => 'Faldas Midi',
                'descripcion' => 'Faldas de longitud media que llegan hasta la mitad de la pantorrilla, ofreciendo versatilidad y estilo para mujeres en diversas ocasiones.',
                'estado' => 1
            ],
            [
                'categorias_id'=>7,
                'nombre' => 'Sweaters de Lana',
                'descripcion' => 'Sweaters de lana cálidos y confortables en una variedad de estilos y diseños para hombres y mujeres.',
                'estado' => 1
            ],
            [
                'categorias_id'=>7,
                'nombre' => 'Sweaters de Punto',
                'descripcion' => 'Sweaters tejidos a mano o a máquina con detalles de punto, ideales para los días fríos y las noches acogedoras para hombres y mujeres.',
                'estado' => 1
            ],
            [
                'categorias_id'=>7,
                'nombre' => 'Sweaters con Cuello de Tortuga',
                'descripcion' => 'Sweaters con cuello alto y ajustado que proporcionan calidez y estilo adicional para hombres y mujeres.',
                'estado' => 1
            ],
            [
                'categorias_id'=>8,
                'nombre' => 'Abrigos de Invierno',
                'descripcion' => 'Abrigos gruesos y cálidos diseñados para proteger contra el frío y el viento durante los meses de invierno.',
                'estado' => 1
            ],
            [
                'categorias_id'=>8,
                'nombre' => 'Abrigos Parka',
                'descripcion' => 'Abrigos largos y acolchados con capucha, ideales para condiciones climáticas extremas y actividades al aire libre.',
                'estado' => 1
            ],
            [
                'categorias_id'=>8,
                'nombre' => 'Abrigos de Lana',
                'descripcion' => 'Abrigos elegantes y abrigados fabricados con lana de alta calidad, adecuados para el uso diario y ocasiones especiales.',
                'estado' => 1
            ],
            [
                'categorias_id'=>9,
                'nombre' => 'Sujetadores',
                'descripcion' => 'Sujetadores en una variedad de estilos y tallas para mujeres, ofreciendo comodidad y soporte durante todo el día.',
                'estado' => 1
            ],
            [
                'categorias_id'=>9,
                'nombre' => 'Calzoncillos',
                'descripcion' => 'Calzoncillos de algodón suave y elástico en diferentes cortes y diseños para hombres, proporcionando comodidad y ajuste.',
                'estado' => 1
            ],
            [
                'categorias_id'=>9,
                'nombre' => 'Conjuntos de Lencería',
                'descripcion' => 'Conjuntos coordinados de sujetador y braguita en una variedad de estilos y materiales para mujeres, ideales para ocasiones especiales.',
                'estado' => 1
            ],
            [
                'categorias_id'=>10,
                'nombre' => 'Bikinis',
                'descripcion' => 'Conjuntos de bikini de dos piezas en una variedad de estilos y estampados para mujeres, perfectos para días de playa y piscina.',
                'estado' => 1
            ],
            [
                'categorias_id'=>10,
                'nombre' => 'Trajes de Baño de Una Pieza',
                'descripcion' => 'Trajes de baño de una sola pieza en una variedad de diseños y cortes para mujeres, ofreciendo cobertura y estilo.',
                'estado' => 1
            ],
            [
                'categorias_id'=>10,
                'nombre' => 'Bañadores Shorts',
                'descripcion' => 'Bañadores cortos para hombres en una variedad de colores y estilos, ideales para actividades acuáticas y días soleados en la playa.',
                'estado' => 1
            ]

        ];

        // Crear las subcategorías utilizando el array
        foreach ($subcategorias as $subcategoria) {
            Subcategorias::create($subcategoria);
        }
    }
}
