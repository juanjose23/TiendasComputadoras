<?php

namespace App\Livewire;

use App\Models\Categorias;
use App\Models\Colores;

use App\Models\Cortes;
use App\Models\Detalle_productos;
use App\Models\Detalles_Lotes;
use App\Models\Marcas;
use App\Models\Tallas;
use Livewire\Component;

class Shops extends Component
{
    public $categoriaSeleccionada = null;
    public $marcaSeleccionada = null;

    public $perPage = 9;
    public function render()
    {
        
        $productos = Detalle_productos::with(['precios'])
        ->whereHas('precios', function ($query) {
            $query->where('estado', 1);
        })
        ->whereHas('detalleslotes', function($query) {
            $query->where('cantidad', '>=', 1); // Corregir la comparación aquí
        })
        ->paginate($this->perPage);
        $marcas = Marcas::whereHas('modelos.productos')
            ->where('estado', 1)
            ->get();
        $categorias = Categorias::whereHas('subcategorias.productos')
            ->where('estado', 1)
            ->get();

        $colores = Colores::whereHas('coloresproductos.productos')
            ->where('estado', 1)
            ->get();
        $tallas = Tallas::whereHas('tallasproductos.productos')
            ->where('estado', 1)
            ->get();
        $cortes = Cortes::whereHas('cortesproductos.productos')
            ->where('estado', 1)
            ->get();
        return view('livewire.shops', compact('productos', 'marcas', 'categorias', 'colores', 'tallas', 'cortes'));
    }
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        $this->gotoPage(1); // Reiniciar el paginado a la página 1
    }
}
