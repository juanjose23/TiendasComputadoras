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
                'nombre' => 'Samsung',
                'descripcion' => 'Samsung Electronics es una empresa surcoreana que fabrica una amplia gama de productos electrónicos, incluyendo smartphones, televisores, electrodomésticos y componentes de computadoras.',
                'paises_id' => 112,
                'sitio_web' => 'https://www.samsung.com/',
                'estado' => 1
            ],
            [
                'nombre' => 'Apple',
                'descripcion' => 'Apple es una empresa estadounidense conocida por sus dispositivos electrónicos, como el iPhone, iPad, Mac, Apple Watch y Apple TV, así como por su software y servicios.',
                'paises_id' => 161,
                'sitio_web' => 'https://www.apple.com/',
                'estado' => 1
            ],
            [
                'nombre' => 'Sony',
                'descripcion' => 'Sony es una empresa japonesa que fabrica una amplia gama de productos electrónicos, incluyendo televisores, cámaras, consolas de videojuegos (PlayStation), audio y video, entre otros.',
                'paises_id' => 121,
                'sitio_web' => 'https://www.sony.com/',
                'estado' => 1
            ],
            [
                'nombre' => 'LG',
                'descripcion' => 'LG Electronics es una empresa surcoreana que fabrica productos electrónicos, electrodomésticos y dispositivos móviles, como televisores, refrigeradores, lavadoras, smartphones y más.',
                'paises_id' => 112,
                'sitio_web' => 'https://www.lg.com/',
                'estado' => 1
            ],
            [
                'nombre' => 'Microsoft',
                'descripcion' => 'Microsoft es una empresa estadounidense que desarrolla, fabrica, licencia y vende una amplia gama de software, hardware y servicios relacionados con la informática.',
                'paises_id' => 161,
                'sitio_web' => 'https://www.microsoft.com/',
                'estado' => 1
            ],
            [
                'nombre' => 'Panasonic',
                'descripcion' => 'Panasonic es una empresa japonesa que fabrica productos electrónicos, electrodomésticos, componentes y sistemas industriales, incluyendo televisores, cámaras, equipos de audio y más.',
                'paises_id' => 121,
                'sitio_web' => 'https://www.panasonic.com/',
                'estado' => 1
            ],
            [
                'nombre' => 'HP (Hewlett-Packard)',
                'descripcion' => 'HP es una empresa estadounidense que fabrica una amplia gama de productos electrónicos y hardware de computadora, incluyendo computadoras portátiles, de escritorio, impresoras y más.',
                'paises_id' => 161,
                'sitio_web' => 'https://www.hp.com/',
                'estado' => 1
            ],
            [
                'nombre' => 'Dell',
                'descripcion' => 'Dell es una empresa estadounidense que fabrica computadoras personales, servidores, dispositivos de almacenamiento, redes, software y más, con un enfoque en soluciones empresariales.',
                'paises_id' => 161,
                'sitio_web' => 'https://www.dell.com/',
                'estado' => 1
            ],
            [
                'nombre' => 'Canon',
                'descripcion' => 'Canon es una empresa japonesa que fabrica productos electrónicos, incluyendo cámaras digitales, impresoras, escáneres, dispositivos médicos y soluciones de imagen y óptica.',
                'paises_id' => 121,
                'sitio_web' => 'https://www.canon.com/',
                'estado' => 1
            ],
            [
                'nombre' => 'ASUS',
                'descripcion' => 'ASUS es una empresa taiwanesa que fabrica una amplia gama de productos electrónicos, incluyendo computadoras portátiles, tarjetas madre, tarjetas gráficas, monitores y dispositivos de red.',
                'paises_id' => 209,
                'sitio_web' => 'https://www.asus.com/',
                'estado' => 1
            ]
        ];

        // Crear las marcas utilizando el array
        foreach ($marcas as $marca) {
            Marcas::create($marca);
        }
    }
}
