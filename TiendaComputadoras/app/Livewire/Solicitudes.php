<?php

namespace App\Livewire;

use App\Models\Solicitud_compra;
use Livewire\Component;
use Livewire\WithPagination;

class Solicitudes extends Component
{
    use WithPagination;
    public $buscar = '';
    public $perPage = 10;
    public $sortColumn = 'notas';
    public $sortDirection = 'asc';

    public function render()
    {

        $Solicitudes = Solicitud_compra::with([
            'empleados',
            'empleados.personas',
            'detallessolicitud',
            'detallessolicitud.productosdetalles',
            'detallessolicitud.productosdetalles.productos',
            'detallessolicitud.productosdetalles.productos.subcategorias',
            'detallessolicitud.productosdetalles.productos.modelos',
            'detallessolicitud.productosdetalles.productos.modelos.marcas',
            'detallessolicitud.productosdetalles.productos.subcategorias.categorias',
            'detallessolicitud.productosdetalles.tallasproductos',
            'detallessolicitud.productosdetalles.coloresproductos',
            'detallessolicitud.productosdetalles.cortesproductos',
            'detallessolicitud.productosdetalles.tallasproductos.tallas',
            'detallessolicitud.productosdetalles.coloresproductos.colores',
            'detallessolicitud.productosdetalles.cortesproductos.cortes',

        ])
            ->orWhereHas('empleados', function ($query) {
                $query->where('codigo', 'like', '%' . $this->buscar . '%');
            })
            ->orWhereHas('empleados.personas', function ($query) {
                $query->where('nombre', 'like', '%' . $this->buscar . '%');
            })
            ->orWhereHas('detallessolicitud.productosdetalles.productos.coloresproductos.colores', function ($query) {
                $query->where('nombre', 'like', '%' . $this->buscar . '%');
            })
            ->orWhereHas('detallessolicitud.productosdetalles.productos', function ($query) {
                $query->where(function ($query) {
                    $query->where('nombre', 'like', '%' . $this->buscar . '%')
                        ->orWhere('codigo', 'like', '%' . $this->buscar . '%');
                });
            })
            ->orWhereHas('detallessolicitud.productosdetalles.productos.subcategorias', function ($query) {
                $query->where('nombre', 'like', '%' . $this->buscar . '%');
            })
            ->orWhereHas('detallessolicitud.productosdetalles.productos.subcategorias.categorias', function ($query) {
                $query->where('nombre', 'like', '%' . $this->buscar . '%');
            })
            ->orWhereHas('detallessolicitud.productosdetalles.productos.modelos', function ($query) {
                $query->where('nombre', 'like', '%' . $this->buscar . '%');
            })
            ->orWhereHas('detallessolicitud.productosdetalles.productos.modelos.marcas', function ($query) {
                $query->where('nombre', 'like', '%' . $this->buscar . '%');
            })
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->perPage);
        return view('livewire.solicitudes', compact('Solicitudes'));
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
