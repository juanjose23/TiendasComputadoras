<?php

namespace App\Http\Controllers;

use App\Exports\AsignacionExport;
use App\Exports\CargosExport;
use App\Exports\ColaboradoresExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Empleados;
use Barryvdh\DomPDF\Facade\Pdf;
class ExportacionesController extends Controller
{
    //
    public function exportcargosexcel()
    {
        return Excel::download(new CargosExport, 'cargos.xlsx');
    }
    public function exportasignaciones()
    {
        return Excel::download(new AsignacionExport, 'asignaciones.xlsx');
    }

    public function exportColaboradores()
    {
        return Excel::download(new ColaboradoresExport, 'empleados.xlsx');
    }

    public function exportColaboradorespdf()
    {
        $empleados=Empleados::with(['personas','personas.persona_naturales'])->get();
        $total=Empleados::count();
        $pdf = Pdf::loadView('report.empleados',['empleados' => $empleados,'total' => $total]);
        $pdf->set_paper('A3', 'landscape');
      
       // Envía el PDF generado al navegador
       return $pdf->download('documento.pdf');
    }
}
