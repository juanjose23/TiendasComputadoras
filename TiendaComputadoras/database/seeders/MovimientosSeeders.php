<?php

namespace Database\Seeders;

use App\Models\movimiento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovimientosSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        movimiento::create([
            'tipo' => 'Entrada',
            
            'descripcion' => 'Ingreso inicial de inventario',
        ]);

        movimiento::create([
            'tipo' => 'Salida',
          
            'descripcion' => 'Venta de productos',
        ]);

        movimiento::create([
            'tipo' => 'Devolución de compra',
            
            'descripcion' => 'Ajuste de inventario por devolucion de compra',
        ]);
        movimiento::create([
            'tipo' => 'Devolución de venta',
           
            'descripcion' => 'Ajuste de inventario por devolucion de venta',
        ]);

    }
}
