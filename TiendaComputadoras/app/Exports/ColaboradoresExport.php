<?php

namespace App\Exports;

use App\Models\Empleados;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;

class ColaboradoresExport implements FromCollection, WithHeadings, WithDrawings
{
    public function collection()
    {
     return  Empleados::with(['personas', 'personas.persona_naturales','personas.persona_naturales.paises'])->get()->map(function ($empleados) {
            // Obtener la URL de la foto de Cloudinary
          
            return [
                'ID' => $empleados->id,
                'Código' => $empleados->codigo,
                'Nombre' => $empleados->personas->nombre,
                'Apellidos' => $empleados->personas->persona_naturales->apellido,
                'Celular' => $empleados->personas->telefono,
                'Correo' => $empleados->personas->correo,
                'Tipo de identificación' => $empleados->personas->persona_naturales->tipo_identificacion,
                'Identificación' => $empleados->personas->persona_naturales->identificacion,
                'Código Inss' => $empleados->inss,
                'Nacionalidad' => $empleados->personas->persona_naturales->paises->nombre,
                'Estado' => $empleados->estado == 1 ? 'Activo' : 'Inactivo'
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Código',
            'Nombre',
            'Apellidos',
            'Celular',
            'Correo',
            'Tipo de identificación',
            'Identificación',
            'Código Inss',
            'Nacionalidad',
            'Estado',
            'Foto'
        ];
    }

    public function drawings()
    {
        $drawings = [];
        $row = 2; // Empezar desde la segunda fila
    
        Empleados::with(['personas', 'personas.persona_naturales'])->get()->each(function ($empleados) use (&$drawings, &$row) {
            // Obtener la URL de la foto almacenada en la base de datos
            $fotoUrl = $empleados->personas->foto;
    
            if ($fotoUrl) {
                // Leer la imagen desde la URL almacenada en la base de datos
                $imageContent = file_get_contents($fotoUrl);
                $imageResource = imagecreatefromstring($imageContent);
    
                if ($imageResource === false) {
                    throw new \Exception('The image URL cannot be converted into an image resource.');
                }
    
                $drawing = new MemoryDrawing();
                $drawing->setName('Foto');
                $drawing->setDescription('Foto del empleado');
                $drawing->setImageResource($imageResource);
                $drawing->setHeight(100);
                $drawing->setCoordinates("L$row"); // Insertar en la columna 'L'
                $drawings[] = $drawing;
            }
    
            $row++;
        });
    
        return $drawings;
    }
    
}
