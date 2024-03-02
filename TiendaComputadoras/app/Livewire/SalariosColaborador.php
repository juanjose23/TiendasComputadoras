<?php

namespace App\Livewire;

use App\Models\Salarios;
use Livewire\Component;
use Livewire\WithPagination;

class SalariosColaborador extends Component
{
    use WithPagination;
    public $buscar = '';
    public $perPage = 10;
    public function render()
    {
        $buscar = $this->buscar;
        $Salarios = Salarios::with(['empleados', 'empleados.personas', 'empleados.personas.persona_naturales'])
            ->whereHas('empleados', function ($query) use ($buscar) { // Añade $buscar aquí
                $query->where('codigo', 'like', '%' . $buscar . '%');
            })
            ->orWhereHas('empleados.personas.persona_naturales', function ($query) use ($buscar) { // Añade $buscar aquí
                $query->where('apellido', 'like', '%' . $buscar . '%')
                    ->orWhere('tipo_identificacion', 'like', '%' . $buscar . '%')
                    ->orWhere('identificacion', 'like', '%' . $buscar . '%');
            })
            ->orWhereHas('empleados.personas', function ($query) use ($buscar) {
                $query->orWhere('telefono', 'like', '%' . $buscar . '%')
                    ->orWhere('correo', 'like', '%' . $buscar . '%')
                    ->orWhere('nombre', 'like', '%' . $buscar . '%');
            })
            ->orWhere('estado', 'like', '%' . $buscar . '%')
            ->orWhere('created_at', 'like', '%' . $buscar . '%')
           ->paginate($this->perPage);
        return view('livewire.salarios-colaborador',compact('Salarios'));
    }
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        $this->gotoPage(1); // Reiniciar el paginado a la página 1
    }
}
