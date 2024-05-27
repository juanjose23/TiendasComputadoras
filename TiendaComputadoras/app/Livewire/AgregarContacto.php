<?php

namespace App\Livewire;

use App\Models\contactosproveedores;
use App\Models\Pais;
use App\Models\Personas;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AgregarContacto extends Component
{
    public $proveedorId;

    public function mount($proveedorId)
    {
        $this->proveedorId = $proveedorId;
    }


    public $nombre = '';
    public $correo = '';
    public $telefono = '';
    public $cargo = '';
    public $pais = '';
    public $estado = '';

    protected $rules = [
        'nombre' => 'required',
        'correo' => 'required|email',
        'telefono' => 'required',
        'cargo' => 'required',
        'pais' => 'required',
        'estado' => 'required'
    ];

    public function save()
    {
        $this->validate();

      
        // Crear la persona y obtener su ID
        $persona =new Personas();

        $persona->nombre =$this->nombre;
        $persona->correo=$this->correo;
        $persona->telefono=$this->telefono;

        $persona->save();
        // Crear el registro en la tabla contactosproveedores
       $proveedor=new ContactosProveedores();
        $proveedor->personas_id = $persona->id;
        $proveedor->proveedores_id = $this->proveedorId;
        $proveedor->paises_id = $this->pais;
        $proveedor->cargo = $this->cargo;
        $proveedor->estado = $this->estado;
        
        $proveedor->save();
        // Redirigir después de guardar
      
        return redirect()->back()->with('success', 'Se ha realizado la operacion éxito');
    }
    public function render()
    {
        $paises = Pais::obtenerPaises();
        return view('livewire.agregar-contacto', compact('paises'));
    }
}
