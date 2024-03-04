<?php

namespace App\Livewire;

use App\Models\Subcategorias as ModelsSubcategorias;
use Livewire\Component;
use Livewire\WithPagination;

class Subcategorias extends Component
{
    use WithPagination;
    public $buscar = '';
    public $perPage = 10;
    public function render()
    {
        $subcategorias = ModelsSubcategorias::with(['categorias'])->where(function ($query) {
            $query->where('nombre', 'like', '%' . $this->buscar . '%')
                ->orWhere('descripcion', 'like', '%' . $this->buscar . '%')
                ->orWhereHas('categorias', function ($query) {
                    $query->where('nombre', 'like', '%' . $this->buscar . '%')
                        ->orWhere('descripcion', 'like', '%' . $this->buscar . '%');
                });
            // Agrega más atributos aquí si deseas incluirlos en la búsqueda
        })->paginate($this->perPage);

        return view('livewire.subcategorias', compact('subcategorias'));
    }
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        $this->gotoPage(1); // Reiniciar el paginado a la página 1
    }
}
