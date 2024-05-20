<?php

namespace App\Http\Controllers;

use App\Exports\AsignacionExport;
use App\Exports\CargosExport;
use App\Exports\CategoriasExport;
use App\Exports\ModelosExport;
use App\Exports\RolesExport;
use App\Exports\SubcategoriasExport;
use App\Exports\ColaboradoresExport;
use App\Exports\ColoresExport;
use App\Exports\CortesExport;
use App\Exports\SalariosExport;
use App\Exports\MarcasExport;
use App\Exports\PreciosExport;
use App\Exports\ProductosExport;
use App\Exports\ProveedoresExport;
use App\Exports\TallasExport;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Empleados;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Salarios;
use App\Models\AsignacionCargos;
use App\Models\Imagen;

class ExportacionesController extends Controller
{
    //
    public function pdf($colaboradores)
    {
        $empleados = Empleados::with(['personas', 'personas.persona_naturales', 'personas.direcciones'])
            ->find($colaboradores);
        $salario = Salarios::ObtenerSalarioColaborador($colaboradores);
        $cargo = AsignacionCargos::obtenerAsignacionesCargos($colaboradores);

        $historial = Salarios::obtenerHistorialSalarios($colaboradores);

        $imagenes = Imagen::where('imagenable_type', 'App\Models\Empleados')
            ->where('imagenable_id', $colaboradores)
            ->get();
        $cargos = AsignacionCargos::with(['cargos'])->where('empleados_id', $colaboradores)->get();
        $pdf = Pdf::loadView('Gestion_Negocio.Colaborador.pdf', compact('empleados', 'salario', 'cargo', 'historial', 'cargos', 'imagenes'));
        $pdf->set_paper('A5');

        // Envía el PDF generado al navegador
        return $pdf->download('empleado' . $empleados->codigo . '.pdf');

    }
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
    public function exportsalarios()
    {
        return Excel::download(new SalariosExport, 'salarios.xlsx');
    }
    public function exportcategorias()
    {
        return Excel::download(new CategoriasExport, 'categorias.xlsx');
    }
    public function exportmarcas()
    {
        return Excel::download(new MarcasExport, 'marcas.xlsx');
    }
    public function exportmodelos()
    {
        return Excel::download(new ModelosExport, 'modelos.xlsx');
    }
    public function exportcolores()
    {
        return Excel::download(new ColoresExport, 'colores.xlsx');
    }
    public function exporttallas()
    {
        return Excel::download(new TallasExport, 'tallas.xlsx');
    }
    public function exportcortes()
    {
        return Excel::download(new CortesExport, 'cortes.xlsx');
    }
    public function exportprecios()
    {
        return Excel::download(new PreciosExport, 'Lista_precios_productos.xlsx');
    }
    public function exportproductos()
    {
        return Excel::download(new ProductosExport, 'productos.xlsx');
    }
    public function exportsubcategorias()
    {
        return Excel::download(new SubcategoriasExport, 'subcategorias.xlsx');
    }
    public function exportColaboradorespdf()
    {
        $empleados = Empleados::with(['personas', 'personas.persona_naturales', 'imagenes'])->get();
        //  return $empleados;
        $total = Empleados::count();
        $pdf = Pdf::loadView('report.empleados', ['empleados' => $empleados, 'total' => $total]);
        $pdf->set_paper('A3', 'landscape');

        // Envía el PDF generado al navegador
        return $pdf->download('documento.pdf');
    }
    //Usuarios
    public function exportroles()
    {
        return Excel::download(new RolesExport, 'roles.xlsx');
    }
    public function exportusuarios()
    {
        return Excel::download(new UsersExport, 'usuario.xlsx');
    }


    //Inventarios

    public function exportproveedores()
    {
        return Excel::download(new ProveedoresExport,'proveedores.xlsx');
    }
}
