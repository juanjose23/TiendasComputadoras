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
                'nombre' => 'LED TV',
                'descripcion' => 'Subcategoría de televisores que utilizan tecnología LED para la iluminación de la pantalla.',
                'estado' => 1
            ],
            [
                'categorias_id'=>1,
                'nombre' => 'OLED TV',
                'descripcion' => 'Subcategoría de televisores que utilizan tecnología OLED para ofrecer una calidad de imagen superior con negros más profundos y colores más vibrantes.',
                'estado' => 1
            ],
            [
                'categorias_id'=>1,
                'nombre' => 'QLED TV',
                'descripcion' => 'Subcategoría de televisores que utilizan tecnología Quantum Dot para mejorar la reproducción del color y ofrecer una experiencia visual más inmersiva con alto rango dinámico (HDR).',
                'estado' => 1
            ],
            [
                'categorias_id'=>1,
                'nombre' => 'Smart TV',
                'descripcion' => 'Subcategoría de televisores que tienen capacidades de conexión a internet y pueden ejecutar aplicaciones, lo que permite el acceso a servicios de streaming, redes sociales y otros contenidos en línea.',
                'estado' => 1
            ],
            [
                'categorias_id'=>1,
                'nombre' => '8K TV',
                'descripcion' => 'Subcategoría de televisores que ofrecen una resolución cuatro veces mayor que la de los televisores 4K, ideal para contenido de alta definición y videojuegos de última generación.',
                'estado' => 1
            ],
            [
                'categorias_id'=>2,
                'nombre' => 'Android',
                'descripcion' => 'Subcategoría de smartphones con sistema operativo Android, conocidos por su amplia variedad de modelos y personalización.',
                'estado' => 1
            ],
            [
                'categorias_id'=>2,
                'nombre' => 'iOS',
                'descripcion' => 'Subcategoría de smartphones con sistema operativo iOS (iPhone), conocidos por su diseño elegante, integración con otros dispositivos Apple y su ecosistema de aplicaciones.',
                'estado' => 1
            ],
            [
                'categorias_id'=>2,
                'nombre' => 'Flagship',
                'descripcion' => 'Subcategoría de smartphones de gama alta (flagship), conocidos por sus especificaciones avanzadas y características premium.',
                'estado' => 1
            ],
            [
                'categorias_id'=>2,
                'nombre' => 'Económicos',
                'descripcion' => 'Subcategoría de smartphones económicos, que ofrecen un buen equilibrio entre precio y rendimiento para aquellos con presupuestos más ajustados.',
                'estado' => 1
            ],
            [
                
                'categorias_id'=>2,
                'nombre' => 'Gaming',
                'descripcion' => 'Subcategoría de smartphones diseñados específicamente para juegos, con características como pantallas de alta tasa de refresco, refrigeración mejorada y botones dedicados para juegos.',
                'estado' => 1
            ],
            [
                'categorias_id'=>3,
                'nombre' => 'Ultrabooks',
                'descripcion' => 'Subcategoría de laptops delgadas y livianas, con diseño elegante y potencia suficiente para tareas cotidianas y profesionales.',
                'estado' => 1
            ],
            [
                'categorias_id'=>3,
                'nombre' => 'Gaming',
                'descripcion' => 'Subcategoría de laptops diseñadas para juegos, con hardware potente, gráficos de alta calidad y características específicas para gaming.',
                'estado' => 1
            ],
            [
                'categorias_id'=>3,
                'nombre' => '2 en 1',
                'descripcion' => 'Subcategoría de laptops con diseño convertible que pueden funcionar como tabletas o laptops según las necesidades del usuario.',
                'estado' => 1
            ],
            [
                'categorias_id'=>3,
                'nombre' => 'Estudiantes',
                'descripcion' => 'Subcategoría de laptops diseñadas para estudiantes, con durabilidad, portabilidad y características adecuadas para tareas escolares y universitarias.',
                'estado' => 1
            ],
            [
                'categorias_id'=>3,
                'nombre' => 'Profesionales',
                'descripcion' => 'Subcategoría de laptops diseñadas para profesionales, con rendimiento superior, seguridad avanzada y capacidad de manejar cargas de trabajo intensivas.',
                'estado' => 1
            ],
            [
                'categorias_id'=>4,
                'nombre' => 'Android',
                'descripcion' => 'Subcategoría de tablets con sistema operativo Android, ofreciendo una amplia variedad de modelos y aplicaciones disponibles en la tienda Google Play.',
                'estado' => 1
            ],
            [
                'categorias_id'=>4,
                'nombre' => 'iOS',
                'descripcion' => 'Subcategoría de tablets con sistema operativo iOS (iPad), conocidas por su diseño elegante, rendimiento fluido y gran cantidad de aplicaciones optimizadas para tablets.',
                'estado' => 1
            ],
            [
                'categorias_id'=>4,
                'nombre' => 'Windows',
                'descripcion' => 'Subcategoría de tablets con sistema operativo Windows, que ofrecen compatibilidad con una amplia gama de software de productividad y la capacidad de funcionar como un portátil con accesorios adicionales.',
                'estado' => 1
            ],
            [
                'categorias_id'=>4,
                'nombre' => '2 en 1',
                'descripcion' => 'Subcategoría de tablets con capacidad de convertirse en laptops gracias a teclados desmontables o plegables, ofreciendo versatilidad para tareas de productividad y entretenimiento.',
                'estado' => 1
            ],
            [
                'categorias_id'=>4,
                'nombre' => 'Gaming',
                'descripcion' => 'Subcategoría de tablets diseñadas específicamente para juegos, con pantallas de alta resolución, altavoces potentes y controles táctiles optimizados para una experiencia de juego inmersiva.',
                'estado' => 1
            ],
            [
                'categorias_id'=>5,
                'nombre' => 'DSLR',
                'descripcion' => 'Subcategoría de cámaras digitales de lentes intercambiables, conocidas por su calidad de imagen, versatilidad y controles manuales, ideales para fotógrafos aficionados y profesionales.',
                'estado' => 1
            ],
            [
                'categorias_id'=>5,
                'nombre' => 'Mirrorless',
                'descripcion' => 'Subcategoría de cámaras digitales sin espejo, ofreciendo un diseño más compacto y ligero que las DSLR pero con rendimiento y calidad de imagen comparables, populares entre fotógrafos que buscan portabilidad y versatilidad.',
                'estado' => 1
            ],
            [
                'categorias_id'=>5,
                'nombre' => 'Compactas',
                'descripcion' => 'Subcategoría de cámaras digitales compactas y ligeras, ideales para capturar momentos en movimiento con facilidad, siendo convenientes para viajes y uso diario.',
                'estado' => 1
            ],
            [
                'categorias_id'=>5,
                'nombre' => 'Bridge',
                'descripcion' => 'Subcategoría de cámaras digitales con características de cámaras DSLR pero con un diseño compacto similar al de las cámaras compactas, ofreciendo un equilibrio entre versatilidad y portabilidad.',
                'estado' => 1
            ],
            [
                'categorias_id'=>5,
                'nombre' => 'Acción',
                'descripcion' => 'Subcategoría de cámaras digitales diseñadas para capturar actividades deportivas y de acción, ofreciendo resistencia al agua, golpes y condiciones extremas, y siendo compatibles con una amplia gama de accesorios de montaje.',
                'estado' => 1
            ],
            [
                'categorias_id'=>6,
                'nombre' => 'In-Ear',
                'descripcion' => 'Subcategoría de auriculares que se insertan dentro del canal auditivo, ofreciendo portabilidad y aislamiento de ruido, ideales para uso en movimiento y deportes.',
                'estado' => 1
            ],
            [
                'categorias_id'=>6,
                'nombre' => 'On-Ear',
                'descripcion' => 'Subcategoría de auriculares que descansan sobre la oreja, ofreciendo comodidad y calidad de sonido equilibrada, ideales para uso diario y viajes.',
                'estado' => 1
            ],
            [
                'categorias_id'=>6,
                'nombre' => 'Over-Ear',
                'descripcion' => 'Subcategoría de auriculares que cubren toda la oreja, ofreciendo comodidad excepcional y calidad de sonido inmersiva, ideales para sesiones de escucha prolongadas y uso profesional.',
                'estado' => 1
            ],
            [
                'categorias_id'=>7,
                'nombre' => 'Altavoces Bluetooth',
                'descripcion' => 'Subcategoría de altavoces que se conectan de forma inalámbrica mediante tecnología Bluetooth, ofreciendo portabilidad y facilidad de uso con dispositivos móviles y otros dispositivos compatibles.',
                'estado' => 1
            ],
            [
                'categorias_id'=>7,
                'nombre' => 'Altavoces Hi-Fi',
                'descripcion' => 'Subcategoría de altavoces de alta fidelidad, diseñados para ofrecer una reproducción de sonido de alta calidad y fidelidad, ideales para audiófilos y entusiastas de la música.',
                'estado' => 1
            ],
            [
                'categorias_id'=>8,
                'nombre' => 'Acción',
                'descripcion' => 'Subcategoría de videojuegos que se centran en la acción y el combate, con mecánicas de juego intensas y emocionantes.',
                'estado' => 1
            ],
            [
                'categorias_id'=>8,
                'nombre' => 'Aventura',
                'descripcion' => 'Subcategoría de videojuegos que se centran en la exploración y la narrativa, con mundos expansivos y tramas envolventes.',
                'estado' => 1
            ],
            [
                'categorias_id'=>8,
                'nombre' => 'Deportes',
                'descripcion' => 'Subcategoría de videojuegos que se centran en deportes y competiciones, con simulaciones realistas y modos de juego variados.',
                'estado' => 1
            ],
            [
                'categorias_id'=>9,
                'nombre' => 'Teclados',
                'descripcion' => 'Subcategoría de accesorios de computadora que incluye teclados, ofreciendo diferentes diseños, tamaños y tecnologías, ideales para tareas de escritura y productividad.',
                'estado' => 1
            ],
            [
                'categorias_id'=>9,
                'nombre' => 'Ratones',
                'descripcion' => 'Subcategoría de accesorios de computadora que incluye ratones (mouses), ofreciendo diferentes estilos, tamaños y características, ideales para navegación y precisión en diferentes tipos de trabajo.',
                'estado' => 1
            ],
            [
                'categorias_id'=>9,
                'nombre' => 'Monitores',
                'descripcion' => 'Subcategoría de accesorios de computadora que incluye monitores, ofreciendo diferentes tamaños, resoluciones y tecnologías de pantalla, ideales para ampliar el espacio de trabajo y mejorar la experiencia visual.',
                'estado' => 1
            ],
            [
                'categorias_id'=>9,
                'nombre' => 'Fundas y Maletines',
                'descripcion' => 'Subcategoría de accesorios de computadora que incluye fundas y maletines, diseñados para proteger y transportar computadoras portátiles y otros dispositivos de forma segura y cómoda.',
                'estado' => 1
            ],
            [
                'categorias_id'=>9,
                'nombre' => 'Auriculares y Micrófonos',
                'descripcion' => 'Subcategoría de accesorios de computadora que incluye auriculares y micrófonos, ideales para comunicaciones, conferencias en línea, juegos y multimedia, ofreciendo calidad de audio y comodidad de uso.',
                'estado' => 1
            ],
            [
                'categorias_id'=>10,
                'nombre' => 'Discos Duros Externos',
                'descripcion' => 'Subcategoría de dispositivos de almacenamiento externos que ofrecen capacidad adicional para respaldos y almacenamiento de datos, ideales para transferencia de archivos y portabilidad.',
                'estado' => 1
            ],
            [
                'categorias_id'=>10,
                'nombre' => 'Unidades Flash USB',
                'descripcion' => 'Subcategoría de dispositivos de almacenamiento portátiles y compactos que utilizan memoria flash, ideales para transferir y transportar archivos de manera conveniente y rápida.',
                'estado' => 1
            ],
            [
                'categorias_id'=>10,
                'nombre' => 'Tarjetas de Memoria',
                'descripcion' => 'Subcategoría de dispositivos de almacenamiento que se utilizan en cámaras, teléfonos y otros dispositivos para almacenar fotos, videos y otros archivos multimedia, ofreciendo diferentes capacidades y velocidades.',
                'estado' => 1
            ]
        ];

        // Crear las subcategorías utilizando el array
        foreach ($subcategorias as $subcategoria) {
            Subcategorias::create($subcategoria);
        }
    }
}
