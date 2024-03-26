<?php

namespace App\Livewire;

use App\Models\permisosroles;
use Livewire\Component;
use Livewire\WithPagination;

class Permisos extends Component
{
    use WithPagination;
    public $buscar = '';
    public $perPage = 10;
    public function render()
    {
        $roles = permisosroles::with(['permisosmodulos', 'roles'])
        ->select('roles_id', permisosroles::raw('COUNT(permisosmodulos_id) as cantidad'))
        ->groupBy('roles_id')
        ->where(function ($query) {
            $query->orWhereHas('roles', function ($query) {
                $query->where('nombre', 'like', '%' . $this->buscar . '%');
                $query->where('descripcion', 'like', '%' . $this->buscar . '%');
            });
        })
       
        ->paginate($this->perPage);
        return view('livewire.permisos',compact('roles'));
    }
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        $this->gotoPage(1); // Reiniciar el paginado a la página 1
    }
}
