<?php

namespace App\Livewire;
use App\Models\Detalle_productos;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class Detallesproductos extends Component
{
    use WithPagination;
    private $id;
    public $buscar = '';
    public $perPage = 10;
    public function mount(Request $request)
    {
        $producto = json_decode($request->productos);
        $this->id = $producto->id;
    }
    
    
    public function render()
    {
        $detalle = Detalle_productos::with(['tallasproductos', 'coloresproductos', 'cortesproductos', 'tallasproductos.tallas', 'coloresproductos.colores', 'cortesproductos.cortes'])->where('productos_id',$this->id)->paginate($this->perPage);;

        return view('livewire.detallesproductos',compact('detalle'));
    }

    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        $this->gotoPage(1); // Reiniciar el paginado a la página 1
    }
}
