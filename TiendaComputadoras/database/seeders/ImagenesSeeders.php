<?php

namespace Database\Seeders;

use App\Models\Imagen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImagenesSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $direcciones = [
            [
                'url' =>'https://res.cloudinary.com/dxtlbsa62/image/upload/v1710829297/empleados/noypkvrqqvhpmpereg5k.jpg',
                'public_id'=>'empleados/noypkvrqqvhpmpereg5k',
                'imagenable_type'=>'App\Models\Empleados',
                'imagenable_id'=>1,
               
            ],
            [
                'url' =>'https://res.cloudinary.com/dxtlbsa62/image/upload/v1710829405/empleados/gsblkrzgsvky4ibit1yy.jpg',
                'public_id'=>'empleados/gsblkrzgsvky4ibit1yy',
                'imagenable_type'=>'App\Models\Empleados',
                'imagenable_id'=>2,
               
            ],
            [
                'url' =>'https://res.cloudinary.com/dxtlbsa62/image/upload/v1710829634/empleados/swbbytamtdca1pdjzfil.png',
                'public_id'=>'empleados/swbbytamtdca1pdjzfil',
                'imagenable_type'=>'App\Models\Empleados',
                'imagenable_id'=>3,
               
            ],
            [
                'url' =>'https://res.cloudinary.com/dxtlbsa62/image/upload/v1710829680/empleados/fy85rexhzm01xntukyfq.jpg',
                'public_id'=>'empleados/fy85rexhzm01xntukyfq',
                'imagenable_type'=>'App\Models\Empleados',
                'imagenable_id'=>4,
               
            ],
            [
                'url' =>'https://res.cloudinary.com/dxtlbsa62/image/upload/v1710829705/empleados/ooaeg8uthuwtoj0ob01l.jpg',
                'public_id'=>'empleados/ooaeg8uthuwtoj0ob01l',
                'imagenable_type'=>'App\Models\Empleados',
                'imagenable_id'=>5,
               
            ],

          

        ];
        foreach ($direcciones as $direccion) {
            Imagen::create($direccion);
        }
    }
}
