<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Usuarios extends Component
{
    use WithPagination;
    public $buscar = '';
    public $perPage = 10;

    public function render()
    {
        $usuarios = User::with(['personas', 'personas.persona_naturales', 'personas.empleados'])->whereHas('rolesusuarios', function ($query) {
            $query->where('roles_id', '!=', 1);
        })->where(function ($query) {

            $query->where('usuario', 'like', '%' . $this->buscar . '%')
                ->orWhereHas('personas', function ($query) {
                    $query->where('nombre', 'like', '%' . $this->buscar . '%');
                })
                ->orWhereHas('personas.persona_naturales', function ($query) {
                    $query->where('apellido', 'like', '%' . $this->buscar . '%');
                })
                ->orWhereHas('personas.empleados', function ($query) {
                    $query->where('codigo', 'like', '%' . $this->buscar . '%');
                });
            // Agrega más atributos aquí si deseas incluirlos en la búsqueda
        })->paginate($this->perPage);
        return view('livewire.usuarios', compact('usuarios'));
    }
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        $this->gotoPage(1); // Reiniciar el paginado a la página 1
    }
}
