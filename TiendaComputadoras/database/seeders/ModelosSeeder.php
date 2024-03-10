<?php

namespace Database\Seeders;

use App\Models\Modelos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModelosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $modelos = [
            [
                'marcas_id'=>1,
                'nombre' => 'Galaxy S21',
                'descripcion' => 'El Galaxy S21 es el último teléfono insignia de Samsung, con un diseño elegante, potentes especificaciones y cámaras de alta calidad.',
                'estado' => 1
            ],
            [
                'marcas_id'=>1,
                'nombre' => 'Galaxy Tab S7',
                'descripcion' => 'La Galaxy Tab S7 es una tablet Android de alta gama con una pantalla impresionante, un potente rendimiento y compatibilidad con el S Pen.',
                'estado' => 1
            ],
            [
                'marcas_id'=>1,
                'nombre' => 'Samsung Q90T',
                'descripcion' => 'El Samsung Q90T es un televisor QLED de alta gama con una calidad de imagen excepcional, un diseño elegante y características avanzadas.',
                'estado' => 1
            ],
            [
                'marcas_id'=>2,
                'nombre' => 'iPhone 12',
                'descripcion' => 'El iPhone 12 es el último smartphone de Apple, con un diseño renovado, potente rendimiento y cámaras mejoradas.',
                'estado' => 1
            ],
            [
                'marcas_id'=>2,
                'nombre' => 'MacBook Pro 16"',
                'descripcion' => 'El MacBook Pro de 16 pulgadas es una potente computadora portátil diseñada para profesionales, con una pantalla impresionante, rendimiento excepcional y teclado mejorado.',
                'estado' => 1
            ],
            [
                'marcas_id'=>2,
                'nombre' => 'Apple Watch Series 6',
                'descripcion' => 'El Apple Watch Series 6 es el último reloj inteligente de Apple, con características avanzadas de salud y fitness, pantalla siempre encendida y un diseño elegante.',
                'estado' => 1
            ],
            [
                'marcas_id'=>3,
                'nombre' => 'PlayStation 5',
                'descripcion' => 'La PlayStation 5 es la última consola de videojuegos de Sony, con potente rendimiento, gráficos impresionantes y una amplia variedad de juegos.',
                'estado' => 1
            ],
            [
                'marcas_id'=>3,
                'nombre' => 'Sony Xperia 1 III',
                'descripcion' => 'El Sony Xperia 1 III es el último smartphone de Sony, con una pantalla 4K HDR OLED, cámara fotográfica versátil y un diseño elegante.',
                'estado' => 1
            ],
            [
                'marcas_id'=>3,
                'nombre' => 'Sony Bravia A80J',
                'descripcion' => 'El Sony Bravia A80J es un televisor OLED de alta gama con una calidad de imagen excepcional, tecnología de audio inmersiva y funciones inteligentes avanzadas.',
                'estado' => 1
            ],
           
            [
                'marcas_id' => 3,
                'nombre' => 'Sony Xperia 5 III',
                'descripcion' => 'El Sony Xperia 5 III es un smartphone de gama alta con un diseño compacto, potente rendimiento y cámaras de alta calidad.',
                'estado' => 1
            ],
            [
                'marcas_id' => 3,
                'nombre' => 'Sony WH-1000XM4',
                'descripcion' => 'Los Sony WH-1000XM4 son auriculares con cancelación de ruido líderes en su clase, ofreciendo una experiencia auditiva inmersiva y comodidad excepcional.',
                'estado' => 1
            ],
            // Agrega más modelos para Sony aquí...
            [
                'marcas_id' => 4,
                'nombre' => 'LG OLED CX',
                'descripcion' => 'El LG OLED CX es un televisor OLED de alta calidad con una pantalla impresionante, funciones inteligentes y un diseño elegante.',
                'estado' => 1
            ],
            [
                'marcas_id' => 4,
                'nombre' => 'LG Gram 17',
                'descripcion' => 'El LG Gram 17 es una computadora portátil ultraligera con una pantalla grande, potente rendimiento y una duración de batería excepcional.',
                'estado' => 1
            ],
            [
                'marcas_id' => 4,
                'nombre' => 'LG VELVET',
                'descripcion' => 'El LG VELVET es un smartphone elegante con una pantalla OLED, cámaras versátiles y un diseño atractivo.',
                'estado' => 1
            ],
            [
                'marcas_id' => 5, // Microsoft
                'nombre' => 'Surface Laptop 4',
                'descripcion' => 'La Surface Laptop 4 es una computadora portátil elegante y potente, diseñada para profesionales y usuarios exigentes.',
                'estado' => 1
            ],
            [
                'marcas_id' => 5,
                'nombre' => 'Surface Pro 7',
                'descripcion' => 'La Surface Pro 7 es una tablet versátil con funciones de laptop, ideal para la productividad y la creatividad en movimiento.',
                'estado' => 1
            ],
            [
                'marcas_id' => 5,
                'nombre' => 'Xbox Series X',
                'descripcion' => 'La Xbox Series X es la última consola de videojuegos de Microsoft, con potencia de próxima generación y capacidades de juego inmersivas.',
                'estado' => 1
            ],
            [
                'marcas_id' => 6, // Panasonic
                'nombre' => 'Panasonic Lumix GH5',
                'descripcion' => 'La Panasonic Lumix GH5 es una cámara digital de alta gama diseñada para fotógrafos y videógrafos profesionales.',
                'estado' => 1
            ],
            [
                'marcas_id' => 6,
                'nombre' => 'Panasonic Viera CX800',
                'descripcion' => 'El Panasonic Viera CX800 es un televisor LED con una calidad de imagen impresionante y funciones inteligentes avanzadas.',
                'estado' => 1
            ],
            [
                'marcas_id' => 6,
                'nombre' => 'Panasonic Toughbook CF-33',
                'descripcion' => 'El Panasonic Toughbook CF-33 es una computadora portátil resistente y duradera diseñada para entornos industriales y exteriores.',
                'estado' => 1
            ],
            [
                'marcas_id' => 7, // HP (Hewlett-Packard)
                'nombre' => 'HP Pavilion 15',
                'descripcion' => 'El HP Pavilion 15 es una computadora portátil versátil con un diseño elegante, pantalla de alta definición y rendimiento confiable.',
                'estado' => 1
            ],
            [
                'marcas_id' => 7,
                'nombre' => 'HP ENVY 27',
                'descripcion' => 'El HP ENVY 27 es un monitor de alta resolución con diseño delgado, imágenes vibrantes y funciones de conectividad avanzadas.',
                'estado' => 1
            ],
            [
                'marcas_id' => 7,
                'nombre' => 'HP LaserJet Pro MFP M428fdw',
                'descripcion' => 'La HP LaserJet Pro MFP M428fdw es una impresora multifuncional rápida y confiable diseñada para la productividad en la oficina.',
                'estado' => 1
            ],
            [
                'marcas_id' => 8, // Dell
                'nombre' => 'Dell XPS 15',
                'descripcion' => 'El Dell XPS 15 es una computadora portátil premium con una pantalla impresionante, rendimiento potente y diseño elegante.',
                'estado' => 1
            ],
            [
                'marcas_id' => 8,
                'nombre' => 'Dell UltraSharp U2720Q',
                'descripcion' => 'El Dell UltraSharp U2720Q es un monitor 4K con colores precisos, amplio ángulo de visión y ergonomía mejorada para una experiencia de visualización óptima.',
                'estado' => 1
            ],
            [
                'marcas_id' => 9, // Canon
                'nombre' => 'Canon EOS R5',
                'descripcion' => 'La Canon EOS R5 es una cámara mirrorless de alta resolución con capacidad de grabación de video 8K y enfoque automático avanzado.',
                'estado' => 1
            ],
            [
                'marcas_id' => 9,
                'nombre' => 'Canon PIXMA TR8520',
                'descripcion' => 'La Canon PIXMA TR8520 es una impresora multifunción compacta con conexión inalámbrica, escaneo a color y fax.',
                'estado' => 1
            ],
            [
                'marcas_id' => 9,
                'nombre' => 'Canon CanoScan LiDE 400',
                'descripcion' => 'El Canon CanoScan LiDE 400 es un escáner de documentos compacto con alta resolución y conexión USB.',
                'estado' => 1
            ],
            [
                'marcas_id' => 10, // ASUS
                'nombre' => 'ASUS ZenBook 14',
                'descripcion' => 'El ASUS ZenBook 14 es un portátil ultradelgado con una pantalla NanoEdge sin bordes, procesadores potentes y una batería de larga duración.',
                'estado' => 1
            ],
            [
                'marcas_id' => 10,
                'nombre' => 'ASUS ROG Strix G15',
                'descripcion' => 'El ASUS ROG Strix G15 es una computadora portátil para juegos con un diseño elegante, potente hardware y una pantalla de alta frecuencia de actualización.',
                'estado' => 1
            ],
            [
                'marcas_id' => 10,
                'nombre' => 'ASUS TUF Gaming VG27AQ',
                'descripcion' => 'El ASUS TUF Gaming VG27AQ es un monitor gaming con tecnología Adaptive Sync, una alta tasa de refresco y una rápida respuesta.',
                'estado' => 1
            ]
        ];

        // Crear los modelos utilizando el array
        foreach ($modelos as $modelo) {
            Modelos::create($modelo);
        }
    }
}
