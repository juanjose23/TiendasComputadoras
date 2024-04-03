<?php

namespace App\Livewire;

use App\Models\Productos;
use Livewire\Component;
use Livewire\WithPagination;

class Producto extends Component
{
    use WithPagination;
    public $buscar = '';
    public $perPage = 10;
    public function render()
    {
        $productos=Productos::with(['modelos','modelos.marcas','subcategorias','subcategorias.categorias'])->where(function ($query) {
            $query->where('nombre', 'like', '%' . $this->buscar . '%')
                ->orWhere('descripcion', 'like', '%' . $this->buscar . '%')
                ->orWhere('fecha_lanzamiento', 'like', '%' . $this->buscar . '%')
                ->orWhereHas('subcategorias', function ($query) {
                    $query->where('nombre', 'like', '%' . $this->buscar . '%');
                })
                ->orWhereHas('subcategorias.categorias', function ($query) {
                    $query->where('nombre', 'like', '%' . $this->buscar . '%');
                })
                ->orWhereHas('modelos', function ($query) {
                    $query->where('nombre', 'like', '%' . $this->buscar . '%');
                })
                ->orWhereHas('modelos.marcas', function ($query) {
                    $query->where('nombre', 'like', '%' . $this->buscar . '%');
                });
               
            // Agrega más atributos aquí si deseas incluirlos en la búsqueda
        })->paginate($this->perPage);
        return view('livewire.producto',compact('productos'));
    }
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        $this->gotoPage(1); // Reiniciar el paginado a la página 1
    }
}
