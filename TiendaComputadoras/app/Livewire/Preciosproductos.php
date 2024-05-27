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
            'productosdetalles',
            'productosdetalles.coloresproductos.colores',
            'productosdetalles.productos' => function ($query) {
                $query->where('estado', 1);
            },
            'productosdetalles.productos.modelos',
            'productosdetalles.productos.modelos.marcas',
            'productosdetalles.productos.subcategorias',
            'productosdetalles.productos.subcategorias.categorias'

        ])
        ->where(function ($query) {
            $query->where('precio', 'like', '%' . $this->buscar . '%')
                ->orWhereHas('productosdetalles.coloresproductos.colores', function ($query) {
                    $query->where('nombre', 'like', '%' . $this->buscar . '%');
                })
                ->orWhereHas('productosdetalles.coloresproductos.colores', function ($query) {
                    $query->where('codigo', 'like', '%' . $this->buscar . '%');
                })
                ->orWhereHas('productosdetalles.productos', function ($query) {
                    $query->where('nombre', 'like', '%' . $this->buscar . '%');
                    $query->where('codigo', 'like', '%' . $this->buscar . '%');
                    $query->Where('descripcion', 'like', '%' . $this->buscar . '%');
                    $query->Where('fecha_lanzamiento', 'like', '%' . $this->buscar . '%');
                })
                ->orWhereHas('productosdetalles.productos.subcategorias', function ($query) {
                    $query->where('nombre', 'like', '%' . $this->buscar . '%');
                })
                ->orWhereHas('productosdetalles.productos.subcategorias.categorias', function ($query) {
                    $query->where('nombre', 'like', '%' . $this->buscar . '%');
                })
                ->orWhereHas('productosdetalles.productos.modelos', function ($query) {
                    $query->where('nombre', 'like', '%' . $this->buscar . '%');
                })
                ->orWhereHas('productosdetalles.productos.modelos.marcas', function ($query) {
                    $query->where('nombre', 'like', '%' . $this->buscar . '%');
                });

        })->paginate($this->perPage);

        return view('livewire.preciosproductos', compact('productos'));
    }
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        $this->gotoPage(1); // Reiniciar el paginado a la página 1
    }
}
