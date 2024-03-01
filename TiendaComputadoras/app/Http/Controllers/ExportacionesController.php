<?php

namespace App\Http\Controllers;

use App\Exports\CargosExport;
use App\Exports\ColaboradoresExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportacionesController extends Controller
{
    //
    public function exportcargosexcel()
    {
        return Excel::download(new CargosExport, 'cargos.xlsx');
    }
    public function exportcargopdf()
    {
        return Excel::download(new CargosExport, 'cargos.pdf', \Maatwebsite\Excel\Excel::DOMPDF, [
            'dompdf' => [
                'paper_size' => 'letter',
                'orientation' => 'landscape', // Cambia a horizontal para que la tabla ocupe todo el ancho
                'margin_top' => 10,
                'margin_right' => 10,
                'margin_bottom' => 10,
                'margin_left' => 10,
                'font' => 'Helvetica', // Cambia a una fuente más suave, como 'Helvetica'
            ],
            'title' => 'Lista de Cargos', // Título del documento
        ]);
    }

    public function exportColaboradores()
    {
        return Excel::download(new ColaboradoresExport, 'empleados.xlsx');
    }
}
