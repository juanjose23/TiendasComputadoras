<?php

namespace App\Livewire;

use App\Models\Precios;
use Livewire\Component;
use Livewire\WithPagination;

class Preciosproductos extends Component
{
    use WithPagination;
    public $buscar = '';
    public $perPage = 10;
    public function render()
    {
        $productos = Precios::with([
            'productoscolores',
            'productoscolores.colores',
            'productoscolores.productos',
            'productoscolores.productos.modelos',
            'productoscolores.productos.modelos.marcas',
            'productoscolores.productos.subcategorias',
            'productoscolores.productos.subcategorias.categorias',
            'productoscolores.productos.detalles'
        ])->where(function ($query) {
            $query->where('precio', 'like', '%' . $this->buscar . '%')
                ->orWhereHas('productoscolores.colores', function ($query) {
                    $query->where('nombre', 'like', '%' . $this->buscar . '%');
                })
                ->orWhereHas('productoscolores.colores', function ($query) {
                    $query->where('codigo', 'like', '%' . $this->buscar . '%');
                })
                ->orWhereHas('productoscolores.productos', function ($query) {
                    $query->where('nombre', 'like', '%' . $this->buscar . '%');
                    $query->where('codigo', 'like', '%' . $this->buscar . '%');
                    $query->Where('descripcion', 'like', '%' . $this->buscar . '%');
                    $query->Where('fecha_lanzamiento', 'like', '%' . $this->buscar . '%');
                })
                ->orWhereHas('productoscolores.productos.subcategorias', function ($query) {
                    $query->where('nombre', 'like', '%' . $this->buscar . '%');
                })
                ->orWhereHas('productoscolores.productos.subcategorias.categorias', function ($query) {
                    $query->where('nombre', 'like', '%' . $this->buscar . '%');
                })
                ->orWhereHas('productoscolores.productos.modelos', function ($query) {
                    $query->where('nombre', 'like', '%' . $this->buscar . '%');
                })
                ->orWhereHas('productoscolores.productos.modelos.marcas', function ($query) {
                    $query->where('nombre', 'like', '%' . $this->buscar . '%');
                })
                ->orWhereHas('productoscolores.productos.detalles', function ($query) {
                    $query->where('dimensiones', 'like', '%' . $this->buscar . '%');
                    $query->orWhere('peso', 'like', '%' . $this->buscar . '%');
                    $query->orWhere('material', 'like', '%' . $this->buscar . '%');
                    $query->orWhere('compatibilidad', 'like', '%' . $this->buscar . '%');
                    $query->orWhere('instrucciones_cuidado', 'like', '%' . $this->buscar . '%');
                    $query->orWhere('instrucciones_montaje', 'like', '%' . $this->buscar . '%');
                    $query->orWhere('caracteristicas_especiales', 'like', '%' . $this->buscar . '%');
                });
        })->paginate($this->perPage);
        
        return view('livewire.preciosproductos',compact('productos'));
    }
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        $this->gotoPage(1); // Reiniciar el paginado a la página 1
    }
}
