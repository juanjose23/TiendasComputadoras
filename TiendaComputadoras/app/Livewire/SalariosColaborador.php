<?php

namespace App\Livewire;

use App\Models\Salarios;
use Livewire\Component;
use Livewire\WithPagination;

class SalariosColaborador extends Component
{
    use WithPagination;
    public $Filtrar = '';
    public $perPage = 10;
    public function render()
    {
        //$buscar=$this->Filtra;
        $buscar = $this->Filtrar;
        $datos = Salarios::with(['empleados', 'empleados.personas', 'empleados.personas.persona_naturales'])
            ->where(function ($query) use ($buscar) {
                $query->where('estado', 1)
                    ->whereHas('empleados', function ($query) use ($buscar) {
                        $query->where('codigo', 'like', '%' . $buscar . '%');
                    })
                    ->orWhereHas('empleados.personas', function ($query) use ($buscar) {
                        $query->where('nombre', 'like', '%' . $buscar . '%')
                            ->orWhere('correo', 'like', '%' . $buscar . '%')
                            ->orWhere('telefono', 'like', '%' . $buscar . '%');
                    })
                    ->orWhereHas('empleados.personas.persona_naturales', function ($query) use ($buscar) {
                        $query->where('apellido', 'like', '%' . $buscar . '%')
                            ->orWhere('tipo_identificacion', 'like', '%' . $buscar . '%')
                            ->orWhere('identificacion', 'like', '%' . $buscar . '%');
                    })
                    ->orWhere('salario', 'like', '%' . $buscar . '%');
            })
            ->paginate($this->perPage);

        return view('livewire.salarios-colaborador', compact('datos'));
    }
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        $this->gotoPage(1); // Reiniciar el paginado a la página 1
    }
}
