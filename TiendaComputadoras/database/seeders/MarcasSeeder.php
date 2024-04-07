<?php

namespace Database\Seeders;

use App\Models\Marcas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarcasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $marcas = [
            [
                'nombre' => 'Nike',
                'descripcion' => 'Nike es una empresa estadounidense especializada en ropa deportiva, calzado y accesorios para atletas y aficionados al deporte en todo el mundo.',
                'paises_id' => 183,
                'sitio_web' => 'https://www.nike.com/',
                'estado' => 1
            ],
            [
                'nombre' => 'Adidas',
                'descripcion' => 'Adidas es una empresa alemana conocida por su amplia gama de productos deportivos, incluyendo ropa, calzado y accesorios para hombres, mujeres y niños.',
                'paises_id' => 76,
                'sitio_web' => 'https://www.adidas.com/',
                'estado' => 1
            ],
            [
                'nombre' => 'Zara',
                'descripcion' => 'Zara es una empresa española de moda rápida que ofrece una amplia gama de ropa y accesorios para hombres, mujeres y niños, con tiendas en todo el mundo.',
                'paises_id' => 189,
                'sitio_web' => 'https://www.zara.com/',
                'estado' => 1
            ],
            [
                'nombre' => 'H&M',
                'descripcion' => 'H&M es una empresa sueca de moda que ofrece ropa y accesorios asequibles y modernos para hombres, mujeres, adolescentes y niños en todo el mundo.',
                'paises_id' => 190,
                'sitio_web' => 'https://www2.hm.com/',
                'estado' => 1
            ],
            [
                'nombre' => 'Gucci',
                'descripcion' => 'Gucci es una marca italiana de moda de lujo conocida por sus productos de alta calidad, incluyendo ropa, bolsos, zapatos y accesorios para hombres y mujeres.',
                'paises_id' => 105,
                'sitio_web' => 'https://www.gucci.com/',
                'estado' => 1
            ],
            [
                'nombre' => 'Hugo Boss',
                'descripcion' => 'Hugo Boss es una empresa alemana de moda de lujo que ofrece una amplia gama de ropa elegante y sofisticada para hombres y mujeres, así como fragancias y accesorios.',
                'paises_id' => 76,
                'sitio_web' => 'https://www.hugoboss.com/',
                'estado' => 1
            ],
            [
                'nombre' => 'Levi\'s',
                'descripcion' => 'Levi\'s es una empresa estadounidense de moda conocida por sus vaqueros y ropa informal, ofreciendo una amplia variedad de estilos y cortes para hombres y mujeres.',
                'paises_id' => 183,
                'sitio_web' => 'https://www.levi.com/',
                'estado' => 1
            ],
            [
                'nombre' => 'Ralph Lauren',
                'descripcion' => 'Ralph Lauren es una marca estadounidense de moda de lujo conocida por su estilo clásico y sofisticado, ofreciendo ropa, accesorios y fragancias para hombres, mujeres y niños.',
                'paises_id' => 183,
                'sitio_web' => 'https://www.ralphlauren.com/',
                'estado' => 1
            ],
            [
                'nombre' => 'Tommy Hilfiger',
                'descripcion' => 'Tommy Hilfiger es una marca estadounidense de moda conocida por su estilo preppy y casual, ofreciendo una amplia gama de ropa y accesorios para hombres, mujeres y niños.',
                'paises_id' => 183,
                'sitio_web' => 'https://global.tommy.com/',
                'estado' => 1
            ],
            [
                'nombre' => 'Calvin Klein',
                'descripcion' => 'Calvin Klein es una marca estadounidense de moda conocida por su estilo minimalista y moderno, ofreciendo una amplia gama de ropa, accesorios, fragancias y productos para el hogar.',
                'paises_id' => 183,
                'sitio_web' => 'https://www.calvinklein.us/',
                'estado' => 1
            ],
           
        ];

        // Crear las marcas utilizando el array
        foreach ($marcas as $marca) {
            Marcas::create($marca);
        }
    }
}
