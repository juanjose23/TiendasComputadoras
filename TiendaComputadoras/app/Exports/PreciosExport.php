<?php

namespace App\Exports;

use App\Models\Imagen;
use App\Models\Personas;
use App\Models\Precios;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PreciosExport implements FromCollection, WithCustomStartCell, Responsable, WithMapping, WithColumnFormatting, WithHeadings, WithColumnWidths, WithDrawings, WithStyles
{

    use Exportable;

    private $filters;
    private $fileName = 'Reportes de precios.xlsx';
    private $writerType = Excel::XLSX;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Precios::with([
            'productosdetalles',
            'productosdetalles.coloresproductos.colores',
            'productosdetalles.productos',
            'productosdetalles.productos.modelos',
            'productosdetalles.productos.modelos.marcas',
            'productosdetalles.productos.subcategorias',
            'productosdetalles.productos.subcategorias.categorias'
        ])->get();
    }

    public function headings(): array
    {
        return [
           
            'Código',
            'Nombre',
            'Marca',
            'Modelo',
            'Categoría',
            'Subcategoría',
            'Descripción',
            'Fecha de Lanzamiento',
            'Estado del producto',
            'Color',
            'Talla',
            'Genero',
            'Corte',
            'Estado del precio',
            'Fecha de creación',
            'Fecha de actualización',

        ];
    }
    public function map($precios): array
    {
        return [

            'Código' => $precios->productosdetalles->productos->codigo,
            'Nombre' => $precios->productosdetalles->productos->nombre,
            'Marca' => $precios->productosdetalles->productos->modelos->marcas->nombre,
            'Modelo' => $precios->productosdetalles->productos->modelos->nombre,
            'Categoría' => $precios->productosdetalles->productos->subcategorias->categorias->nombre,
            'Subcategoría' => $precios->productosdetalles->productos->subcategorias->nombre,
            'Descripción' => $precios->productosdetalles->productos->descripcion,
            'Fecha de lanzamiento' => $precios->productosdetalles->productos->fecha_lanzamiento,
            'Estado del producto' => $precios->productosdetalles->productos->estado == 1 ? 'Activo' : 'Inactivo',
            'Color' => $precios->productosdetalles->coloresproductos->colores->nombre,
            'Talla'=> $precios->productosdetalles->tallasproductos->tallas->nombre,
            'Genero'=> $precios->productosdetalles->generos->nombre,
            'Corte'=> $precios->productosdetalles->cortesproductos->cortes->nombre,
            'Estado del precio' => $precios->estado == 1 ? 'Activo' : 'Inactivo',
            'Fecha de creación'=> $precios->created_at,
            'Fecha de actualización'=> $precios->updated_at,

        ];
    }

    public function startCell(): string
    {
        return 'A10';
    }

    public function columnFormats(): array
    {
        return [
            'I' => 'dd/mm/yyyy',
            'O' => 'dd/mm/yyyy',
            'P' => 'dd/mm/yyyy',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 10,
            'C' => 10,
            'D' => 10,
            'E' => 10,
            'F' => 10,
            'G' => 10,
            'H' => 10,
            'I' => 10,
            'J' => 10,
            'K' => 10,
            'L' => 10,
            'M' => 10,
            'N' => 10,
            'O' => 10,
            'P' => 10,
          
        ];
    }


    public function drawings()
    {
        $personas = Personas::first();
        $imagenes = Imagen::where('imagenable_type', 'App\Models\Personas')
            ->where('imagenable_id', 1)
            ->first() ?? null;
        // URL de la imagen
        $imageUrl = $imagenes->url;

        // Ruta temporal para guardar la imagen
        $tempPath = tempnam(sys_get_temp_dir(), 'drawing');
        file_put_contents($tempPath, file_get_contents($imageUrl));

        // Crear el dibujo
        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName($personas->nombre);
        $drawing->setDescription($personas->nombre);
        $drawing->setPath($tempPath); // Establecer la ruta local
        $drawing->setHeight(90);
        $drawing->setCoordinates('B3');

        return $drawing;
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->setTitle('Reportes precios');
        $sheet->setAutoFilter('A10:P10');
        
        // Establecer estilos para el encabezado
        $sheet->getStyle('A10:P10')->applyFromArray([
            'font' => [
                'bold' => true,
                'name' => 'Arial',
                'size' => 12,
            ],
            'alignment' => [
                'horizontal' => 'center'
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => [
                    'argb' => 'C5D9F1',
                ],
            ],
        ]);
    
        // Establecer bordes para todas las celdas
        $sheet->getStyle('A10:' . $sheet->getHighestColumn() . $sheet->getHighestRow())->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'thin',
                ],
            ],
        ]);
    
        // Ajustar automáticamente el ancho de las columnas
        foreach (range('A', $sheet->getHighestColumn()) as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
    }
    

}
