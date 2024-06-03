<?php

namespace App\Livewire;

use App\Models\Lotes;
use Livewire\Component;
use Livewire\WithPagination;

class Lote extends Component
{
    use WithPagination;
    public $buscar = '';
    public $perPage = 10;
    public $sortColumn = 'numero_lote';
    public $sortDirection = 'asc';

    public function render()
    {
        $buscar = $this->buscar;
        $Lotes = Lotes::with([
            'productosdetalles',
            'productosdetalles.productos',
            'productosdetalles.productos.subcategorias',
            'productosdetalles.productos.modelos',
            'productosdetalles.productos.modelos.marcas',
            'productosdetalles.productos.subcategorias.categorias',
            'productosdetalles.tallasproductos',
            'productosdetalles.coloresproductos',
            'productosdetalles.cortesproductos', 
            'productosdetalles.tallasproductos.tallas',
            'productosdetalles.coloresproductos.colores',
            'productosdetalles.cortesproductos.cortes',
            'movimientos'
        ])
            ->where('numero_lote', 'like', '%' . $this->buscar . '%')
            ->orWhereHas('movimientos', function ($query) {
                $query->where('tipo', 'like', '%' . $this->buscar . '%');
            })
            ->orWhereHas('productosdetalles.productos.coloresproductos.colores', function ($query) {
                $query->where('nombre', 'like', '%' . $this->buscar . '%');
            })
            ->orWhereHas('productosdetalles.productos', function ($query) {
                $query->where(function ($query) {
                    $query->where('nombre', 'like', '%' . $this->buscar . '%')
                        ->orWhere('codigo', 'like', '%' . $this->buscar . '%');
                });
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
            })
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.lote', compact('Lotes'));
    }
    public function sortBy($column)
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortColumn = $column;
            $this->sortDirection = 'asc';
        }
        $this->gotoPage(1);
    }
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        $this->gotoPage(1);
    }
}
