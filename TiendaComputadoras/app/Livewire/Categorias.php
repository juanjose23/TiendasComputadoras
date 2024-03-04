<?php

namespace App\Livewire;

use App\Models\Categorias AS modelcategorias;
use Livewire\Component;
use Livewire\WithPagination;
class Categorias extends Component
{
    use WithPagination;
    public $buscar = '';
    public $perPage = 10;
    
    public function render()
    {
        // Realizar la búsqueda en todos los atributos del modelo
        $Cargo = modelcategorias::where(function ($query) {
            $query->where('nombre', 'like', '%' . $this->buscar . '%')
                ->orWhere('descripcion', 'like', '%' . $this->buscar . '%');
            // Agrega más atributos aquí si deseas incluirlos en la búsqueda
        })->paginate($this->perPage);
        
        return view('livewire.categorias', compact('Cargo'));
    }
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        $this->gotoPage(1); // Reiniciar el paginado a la página 1
    }
}