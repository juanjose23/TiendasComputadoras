<?php

namespace App\Exports;

use App\Models\RolesModel;

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

class RolesExport implements
    FromCollection,
    WithCustomStartCell,
    Responsable,
    WithMapping,
    WithColumnFormatting,
    WithHeadings,
    WithColumnWidths,
    WithDrawings,
    WithStyles
{
    use Exportable;

    private $filters;
    private $fileName = 'roles.xlsx';
    private $writerType = Excel::XLSX;

  

    public function collection()
    {
        return RolesModel::all();
    }

    public function map($rol): array
    {
        return [
            '#' => $rol->id,
            'Nombre' => $rol->nombre,
            'Descripción' => $rol->descripcion,
            'Estado' => $rol->estado == 1 ? 'Activo' : 'Inactivo'
        ];
    }

    public function startCell(): string
    {
        return 'A10';
    }

    public function columnFormats(): array
    {
        return [
            'G' => 'dd/mm/yyyy',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 10,
            'C' => 10,
            'D' => 10,
            
        ];
    }

    
    public function drawings()
    {
        // URL de la imagen
        $imageUrl = 'https://res.cloudinary.com/dxtlbsa62/image/upload/v1716184314/empleados/nie7bj2tfw5roxoez1zh.png';
    
        // Ruta temporal para guardar la imagen
        $tempPath = tempnam(sys_get_temp_dir(), 'drawing');
        file_put_contents($tempPath, file_get_contents($imageUrl));
    
        // Crear el dibujo
        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName('Sebras');
        $drawing->setDescription('Sebras');
        $drawing->setPath($tempPath); // Establecer la ruta local
        $drawing->setHeight(90);
        $drawing->setCoordinates('B3');
    
        return $drawing;
    }
    

    public function headings(): array
    {
        return [
            '#',
            'Nombre',
            'Descripción',
            'Estado'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->setTitle('Roles');
        $sheet->setAutoFilter('A10:D10');
        return [
            'A10:D10' => [
                'font' => [
                    'bold' => true,
                    'name' => 'Arial',
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
            ],

            'A10:D' . $sheet->getHighestRow() => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => 'thin',
                    ],
                ],
            ],
        ];
    }
 
}