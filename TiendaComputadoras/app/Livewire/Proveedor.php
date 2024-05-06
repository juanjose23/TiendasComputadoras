<?php

namespace App\Livewire;

use App\Models\Proveedores;
use Livewire\Component;
use Livewire\WithPagination;

class Proveedor extends Component
{
    use WithPagination;
    public $buscar = '';
    public $perPage = 10;
    public function render()
    {
        $buscar = $this->buscar; // Asigna el valor de $this->buscar a una variable local $buscar

        $proveedores = Proveedores::with(['personas','personas.persona_juridicas','personas.persona_naturales'])
        ->whereHas('personas', function ($query) use ($buscar) {
            $query->where('telefono', 'like', '%' . $buscar . '%')
                ->orWhere('correo', 'like', '%' . $buscar . '%')
                ->orWhere('nombre', 'like', '%' . $buscar . '%');
        })
        ->orWhereHas('personas.persona_juridicas', function ($query) use ($buscar) {
            $query->where('razon_social', 'like', '%' . $buscar . '%');
        })
        ->orWhereHas('personas.persona_naturales', function ($query) use ($buscar) {
            $query->where('apellido', 'like', '%' . $buscar . '%');
        })
        ->orWhere('sector_comercial', 'like', '%' . $buscar . '%')
        ->paginate($this->perPage);
    
        return view('livewire.proveedor', compact('proveedores'));
    }
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        $this->gotoPage(1); // Reiniciar el paginado a la página 1
    }
}
