<?php

namespace App\Livewire;

use App\Models\AsignacionCargos;
use App\Models\Empleados AS e;
use App\Models\Personas AS p;
use app\Models\Cargos AS ps;
USE app\Models\Persona_Naturales AS pn;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
class Asignaciones extends Component
{
    use WithPagination;
    public $buscar = '';
    public $perPage = 10;

    public function render()
    {
        $buscar = $this->buscar; // Asigna el valor de $this->buscar a una variable local $buscar
        $datos = AsignacionCargos::with(['empleados', 'empleados.personas', 'empleados.personas.persona_naturales','cargos'])
        ->select('empleados_id', AsignacionCargos::raw('COUNT(cargos_id) as cantidad_cargos'))
        ->groupBy('empleados_id')
        ->whereHas('empleados', function ($query) use ($buscar) { // Añade $buscar aquí
            $query->where('codigo', 'like', '%' . $buscar . '%');
        })
        ->orWhereHas('empleados.personas', function ($query) use ($buscar) { // Añade $buscar aquí
            $query->where('nombre', 'like', '%' . $buscar . '%')
                ->orWhere('correo', 'like', '%' . $buscar . '%')
                ->orWhere('telefono', 'like', '%' . $buscar . '%');
        })
        ->orWhereHas('empleados.personas.persona_naturales', function ($query) use ($buscar) { // Añade $buscar aquí
            $query->where('apellido', 'like', '%' . $buscar . '%')
                ->orWhere('tipo_identificacion', 'like', '%' . $buscar . '%')
                ->orWhere('identificacion', 'like', '%' . $buscar . '%');
        })
        ->orWhereHas('cargos', function ($query) use ($buscar) { // Añade $buscar aquí
            $query->where('nombre', 'like', '%' . $buscar . '%')
                ->orWhere('codigo', 'like', '%' . $buscar . '%')
                ->orWhere('perfil', 'like', '%' . $buscar . '%');
        })->paginate($this->perPage);
        return view('livewire.asignaciones',compact('datos'));
    }

    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        $this->gotoPage(1); // Reiniciar el paginado a la página 1
    }
}
