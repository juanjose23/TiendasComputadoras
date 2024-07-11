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
            
            'proveedores','empleados'
        ])
            ->where('numero_lote', 'like', '%' . $this->buscar . '%')
            
          
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
