<?php

namespace App\Livewire;

use App\Models\Marcas as ModelsMarcas;
use Livewire\Component;
use Livewire\WithPagination;

class Marcas extends Component
{
    use WithPagination;
    public $buscar = '';
    public $perPage = 10;
    public function render()
    {
        $Marcas = ModelsMarcas::with(['paises','imagenes'])->where(function ($query) {
            $query->where('nombre', 'like', '%' . $this->buscar . '%')
                ->orWhere('descripcion', 'like', '%' . $this->buscar . '%')
                ->orWhere('sitio_web', 'like', '%' . $this->buscar . '%')
                ->orWhere('descripcion', 'like', '%' . $this->buscar . '%')
                ->orWhereHas('paises', function ($query) {
                    $query->where('nombre', 'like', '%' . $this->buscar . '%');
                });
            // Agrega más atributos aquí si deseas incluirlos en la búsqueda
        })->paginate($this->perPage);
        return view('livewire.marcas',compact('Marcas'));
    }
}
