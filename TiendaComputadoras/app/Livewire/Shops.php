<?php

namespace App\Livewire;

use App\Models\Categorias;
use App\Models\Colores;

use App\Models\Cortes;
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
        $productos = Detalles_Lotes::with([
            'productos',
            'productos.modelos.marcas',
            'productos.subcategorias.categorias',
            'tallasproductos.tallas',
            'cortesproductos.cortes',
            'coloresproductos.colores',
            'imagenes' => function ($query) {
                $query->where('imagenable_type', 'App\Models\Detalle_productos');
            }
        ])
        ->join('detallesproductos', 'detalles_lotes.productosdetalles_id', '=', 'detallesproductos.id')
        ->join('lote', 'lotes_id', '=', 'lote.id')
        ->join('productos', 'detallesproductos.productos_id', '=', 'productos.id')
        ->join('precios', 'detallesproductos.id', '=', 'precios.productosdetalles_id')
        ->join('colores_productos', 'detallesproductos.id', '=', 'colores_productos.productos_id')
        ->join('tallasproductos', 'detallesproductos.id', '=', 'tallasproductos.productos_id')
        ->join('cortesproductos', 'detallesproductos.id', '=', 'cortesproductos.productos_id')
        ->join('colores', 'colores_productos.colores_id', '=', 'colores.id')
        ->join('tallas', 'tallasproductos.tallas_id', '=', 'tallas.id')
        ->join('cortes', 'cortesproductos.cortes_id', '=', 'cortes.id')
        ->join('modelos', 'productos.modelos_id', '=', 'modelos.id')
        ->join('subcategorias', 'productos.subcategorias_id', '=', 'subcategorias.id')
        ->join('marcas', 'modelos.marcas_id', '=', 'marcas.id')
        ->join('categorias', 'subcategorias.categorias_id', '=', 'categorias.id')
        ->leftJoin('imagenes', 'imagenes.imagenable_id', '=', 'detallesproductos.id')
        ->where('lote.estado', 1)
        ->where('precios.estado', 1)
        ->where('colores_productos.estado', 1)
        ->where('tallasproductos.estado', 1)
        ->where('cortesproductos.estado', 1)
        ->when($this->categoriaSeleccionada, function ($query) {
            $query->where('categorias.id', $this->categoriaSeleccionada);
        })
        ->when($this->marcaSeleccionada, function ($query) {
            $query->where('marcas.id', $this->marcaSeleccionada);
        })
        ->select([
            'productos.*',
            'detallesproductos.*',
            'precios.precio',
            'colores_productos.colores_id',
            'tallasproductos.tallas_id',
            'cortesproductos.cortes_id',
            'colores.nombre as nombre_color',
            'tallas.nombre as nombre_talla',
            'cortes.nombre as nombre_corte',
            'modelos.nombre as nombre_modelo',
            'subcategorias.nombre as nombre_subcategoria',
            'marcas.nombre as nombre_marca',
            'categorias.nombre as nombre_categoria',
            'imagenes.url'
        ])
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
        return view('livewire.shops', compact('productos','marcas','categorias','colores','tallas','cortes'));
    }
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        $this->gotoPage(1); // Reiniciar el paginado a la página 1
    }
}
