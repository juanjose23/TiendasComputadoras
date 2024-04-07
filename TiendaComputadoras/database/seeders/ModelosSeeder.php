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
                'nombre' => 'Air Max 270',
                'descripcion' => 'Las zapatillas Nike Air Max 270 ofrecen una combinación de estilo y comodidad, con una unidad Air Max grande en el talón y colores llamativos.',
                'estado' => 1
            ],
            [
                'marcas_id'=>1,
                'nombre' => 'Air Force 1',
                'descripcion' => 'Las zapatillas Nike Air Force 1 son un clásico de la moda urbana, con un diseño atemporal y materiales de alta calidad que ofrecen durabilidad y estilo.',
                'estado' => 1
            ],
            [
                'marcas_id'=>1,
                'nombre' => 'React Infinity Run',
                'descripcion' => 'Las zapatillas Nike React Infinity Run ofrecen una amortiguación suave y receptiva para correr largas distancias, con un diseño ligero y transpirable para mayor comodidad.',
                'estado' => 1
            ],
            [
                'marcas_id'=>2,
                'nombre' => 'Ultraboost',
                'descripcion' => 'Las zapatillas Adidas Ultraboost ofrecen una combinación de amortiguación y retorno de energía, con un diseño elegante y una parte superior de tejido Primeknit para un ajuste cómodo.',
                'estado' => 1
            ],
            [
                'marcas_id'=>2,
                'nombre' => 'Stan Smith',
                'descripcion' => 'Los tenis Adidas Stan Smith son un icono de estilo urbano, con un diseño minimalista y una parte superior de cuero suave para un look clásico y versátil.',
                'estado' => 1
            ],
            [
                'marcas_id'=>2,
                'nombre' => 'Superstar',
                'descripcion' => 'Los tenis Adidas Superstar son legendarios en el mundo de la moda urbana, con su emblemática puntera de concha y un diseño atemporal que combina con cualquier estilo.',
                'estado' => 1
            ],
            [
                'marcas_id'=>3,
                'nombre' => 'Blazer de Cuadros',
                'descripcion' => 'El blazer de cuadros de Zara es una prenda clásica y elegante, perfecta para completar cualquier conjunto formal o informal con estilo.',
                'estado' => 1
            ],
            [
                'marcas_id'=>3,
                'nombre' => 'Vestido Midi Plisado',
                'descripcion' => 'El vestido midi plisado de Zara es una opción versátil y femenina, ideal para ocasiones casuales o eventos especiales con su diseño elegante y cómodo.',
                'estado' => 1
            ],
            [
                'marcas_id'=>3,
                'nombre' => 'Pantalones Chinos Slim Fit',
                'descripcion' => 'Los pantalones chinos slim fit de Zara son una opción moderna y versátil para cualquier ocasión, con su corte ajustado y su tejido cómodo y duradero.',
                'estado' => 1
            ],
            [
                'marcas_id'=>4,
                'nombre' => 'Jersey de Punto Cuello Alto',
                'descripcion' => 'El jersey de punto con cuello alto de H&M es una prenda versátil y cálida, perfecta para combinar con jeans o faldas en los días fríos de invierno.',
                'estado' => 1
            ],
            [
                'marcas_id'=>4,
                'nombre' => 'Camisa Vaquera Slim Fit',
                'descripcion' => 'La camisa vaquera slim fit de H&M es una opción moderna y casual para cualquier ocasión, con su ajuste favorecedor y su tejido de denim suave y cómodo.',
                'estado' => 1
            ],
            [
                'marcas_id'=>4,
                'nombre' => 'Vestido Estampado Floral',
                'descripcion' => 'El vestido estampado floral de H&M es una opción fresca y femenina para la primavera y el verano, con su diseño ligero y sus colores vibrantes.',
                'estado' => 1
            ],
            [
                'marcas_id'=>5,
                'nombre' => 'Bolso de Cuero con Logo',
                'descripcion' => 'El bolso de cuero con logo de Gucci es un accesorio de lujo y estilo, con su diseño icónico y su artesanía impecable que lo convierten en una pieza deseada por muchos.',
                'estado' => 1
            ],
            [
                'marcas_id'=>5,
                'nombre' => 'Zapatos de Cuero con Hebilla',
                'descripcion' => 'Los zapatos de cuero con hebilla de Gucci son una opción elegante y sofisticada para hombres, con su diseño clásico y su calidad excepcional que los hacen destacar en cualquier ocasión.',
                'estado' => 1
            ],
            [
                'marcas_id'=>5,
                'nombre' => 'Vestido de Seda Estampado',
                'descripcion' => 'El vestido de seda estampado de Gucci es una pieza de alta costura que combina estilo y lujo, con su tela suave y su estampado exclusivo que lo convierten en una elección única para eventos especiales.',
                'estado' => 1
            ],
            [
                'marcas_id'=>6,
                'nombre' => 'Traje de Lana Slim Fit',
                'descripcion' => 'El traje de lana slim fit de Hugo Boss es una opción elegante y sofisticada para hombres, con su corte ajustado y su tejido de alta calidad que lo hacen perfecto para ocasiones formales.',
                'estado' => 1
            ],
            [
                'marcas_id'=>6,
                'nombre' => 'Chaqueta de Cuero Biker',
                'descripcion' => 'La chaqueta de cuero biker de Hugo Boss es una prenda de estilo urbano y contemporáneo, con su diseño atrevido y su artesanía excepcional que la hacen destacar en cualquier ocasión casual.',
                'estado' => 1
            ],
            [
                'marcas_id'=>6,
                'nombre' => 'Blusa de Seda con Lazo',
                'descripcion' => 'La blusa de seda con lazo de Hugo Boss es una opción elegante y femenina para mujeres, con su tejido lujoso y su detalle de lazo que añade un toque de sofisticación a cualquier conjunto.',
                'estado' => 1
            ],
            [
                'marcas_id'=>7,
                'nombre' => 'Jeans 501 Original Fit',
                'descripcion' => 'Los jeans 501 Original Fit de Levi\'s son un clásico de la moda denim, con su corte recto y su estilo atemporal que los hacen perfectos para cualquier ocasión casual.',
                'estado' => 1
            ],
            [
                'marcas_id'=>7,
                'nombre' => 'Chaqueta Trucker',
                'descripcion' => 'La chaqueta Trucker de Levi\'s es una prenda icónica de la moda urbana, con su diseño versátil y su tejido resistente que la convierten en un básico indispensable en el armario.',
                'estado' => 1
            ],
            [
                'marcas_id'=>7,
                'nombre' => 'Camiseta Graphic Tee',
                'descripcion' => 'La camiseta Graphic Tee de Levi\'s es una opción fresca y moderna para cualquier look casual, con sus estampados llamativos y su tejido suave y cómodo.',
                'estado' => 1
            ],
            [
                'marcas_id'=>8,
                'nombre' => 'Polo Classic Fit',
                'descripcion' => 'El polo Classic Fit de Ralph Lauren es un básico de la moda preppy, con su diseño elegante y su tejido de algodón de alta calidad que ofrece comodidad y estilo en cualquier ocasión.',
                'estado' => 1
            ],
            [
                'marcas_id'=>8,
                'nombre' => 'Camisa Oxford Slim Fit',
                'descripcion' => 'La camisa Oxford Slim Fit de Ralph Lauren es una opción sofisticada y versátil para looks casuales o formales, con su corte ajustado y su tejido resistente que la hacen perfecta para cualquier ocasión.',
                'estado' => 1
            ],
            [
                'marcas_id'=>8,
                'nombre' => 'Jersey de Cachemira',
                'descripcion' => 'El jersey de cachemira de Ralph Lauren es una prenda de lujo y estilo, con su tejido suave y cálido que ofrece un look elegante y sofisticado en los días fríos de invierno.',
                'estado' => 1
            ],
            [
                'marcas_id'=>9,
                'nombre' => 'Polo Slim Fit',
                'descripcion' => 'El polo Slim Fit de Tommy Hilfiger es una opción moderna y sofisticada para looks casuales, con su corte ajustado y su emblemático logo bordado que añade un toque de estilo a cualquier conjunto.',
                'estado' => 1
            ],
            [
                'marcas_id'=>9,
                'nombre' => 'Sudadera con Capucha',
                'descripcion' => 'La sudadera con capucha de Tommy Hilfiger es una prenda deportiva y urbana, con su diseño cómodo y su tejido suave que la hacen perfecta para el día a día.',
                'estado' => 1
            ],
            [
                'marcas_id'=>9,
                'nombre' => 'Camisa de Cuadros',
                'descripcion' => 'La camisa de cuadros de Tommy Hilfiger es una opción clásica y versátil para looks casuales, con su diseño atemporal y su tejido de algodón de alta calidad que ofrece comodidad y estilo.',
                'estado' => 1
            ],
            [
                'marcas_id'=>10,
                'nombre' => 'Boxer Briefs Pack de 3',
                'descripcion' => 'Los boxer briefs de Calvin Klein son un básico de la moda íntima masculina, con su ajuste cómodo y su tejido elástico que ofrece sujeción y comodidad durante todo el día.',
                'estado' => 1
            ],
            [
                'marcas_id'=>10,
                'nombre' => 'Camiseta Logo',
                'descripcion' => 'La camiseta logo de Calvin Klein es una prenda casual y moderna, con su diseño simple y su logo icónico que añade un toque de estilo a cualquier look urbano.',
                'estado' => 1
            ],
            [
                'marcas_id'=>10,
                'nombre' => 'Calzoncillos Briefs Pack de 4',
                'descripcion' => 'Los calzoncillos briefs de Calvin Klein son una opción clásica y cómoda para la moda íntima masculina, con su diseño versátil y su tejido suave que ofrece confort durante todo el día.',
                'estado' => 1
            ]
        ];

        // Crear los modelos utilizando el array
        foreach ($modelos as $modelo) {
            Modelos::create($modelo);
        }
    }
}
