<?php

namespace App\Livewire;
use App\Models\Modelos as ModelsModelos;
use Livewire\Component;
use Livewire\WithPagination;
class Modelos extends Component
{
    use WithPagination;
    public $buscar = '';
    public $perPage = 10;
    public function render()
    {
        $Modelos = ModelsModelos::with(['marcas'])->where(function ($query) {
            $query->where('nombre', 'like', '%' . $this->buscar . '%')
                ->orWhere('descripcion', 'like', '%' . $this->buscar . '%')
                ->orWhereHas('marcas', function ($query) {
                    $query->where('nombre', 'like', '%' . $this->buscar . '%');
                });
            // Agrega más atributos aquí si deseas incluirlos en la búsqueda
        })->paginate($this->perPage);
        return view('livewire.modelos',compact('Modelos'));
    }
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        $this->gotoPage(1); // Reiniciar el paginado a la página 1
    }
}
