<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Personas;
use Livewire\WithPagination;
class Colaboradores extends Component
{
    use WithPagination;
    public $buscar = '';
    public $perPage = 10;

    public function render()
    {
        $buscar = $this->buscar; // Asigna el valor de $this->buscar a una variable local $buscar

        $datos = Personas::with(['persona_naturales', 'empleados'])
            ->whereHas('empleados', function ($query) use ($buscar) { // Añade $buscar aquí
                $query->where('codigo', 'like', '%' . $buscar . '%');
            })
            ->orWhereHas('persona_naturales', function ($query) use ($buscar) { // Añade $buscar aquí
                $query->where('apellido', 'like', '%' . $buscar . '%')
                    ->orWhere('tipo_identificacion', 'like', '%' . $buscar . '%')
                    ->orWhere('identificacion', 'like', '%' . $buscar . '%');
            })
            ->orWhere('telefono', 'like', '%' . $buscar . '%')
            ->orWhere('correo', 'like', '%' . $buscar . '%')
            ->orWhere('nombre', 'like', '%' . $buscar . '%')
            ->paginate($this->perPage);

        return view('livewire.colaboradores',compact('datos'));
    }

    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        $this->gotoPage(1); // Reiniciar el paginado a la página 1
    }
}
