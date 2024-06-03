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
        'correo' => 'required|email|unique:personas,correo',
        'telefono' => 'required|unique:personas,telefono',
        'cargo' => 'required',
        'pais' => 'required',
        'estado' => 'required'
    ];

    protected $messages = [
        'nombre.required' => 'El nombre es obligatorio.',
        'correo.required' => 'El correo es obligatorio.',
        'correo.email' => 'El correo debe ser una dirección válida.',
        'correo.unique' => 'El correo ya está registrado.',
        'telefono.unique' => 'El correo ya está registrado.',
        'telefono.required' => 'El teléfono es obligatorio.',
        'cargo.required' => 'El cargo es obligatorio.',
        'pais.required' => 'El país es obligatorio.',
        'estado.required' => 'El estado es obligatorio.'
    ];


    public function save()
    {
        $this->validate();


        // Crear la persona y obtener su ID
        $persona = new Personas();

        $persona->nombre = $this->nombre;
        $persona->correo = $this->correo;
        $persona->telefono = $this->telefono;

        $persona->save();
        // Crear el registro en la tabla contactosproveedores
        $proveedor = new ContactosProveedores();
        $proveedor->personas_id = $persona->id;
        $proveedor->proveedores_id = $this->proveedorId;
        $proveedor->pais_id = $this->pais;
        $proveedor->cargo = $this->cargo;
        $proveedor->estado = $this->estado;

        $proveedor->save();
     
        $this->reset();
        return redirect()->back()->with('success', 'Se ha realizado la operacion éxito');
    }
    public function render()
    {
        $paises = Pais::obtenerPaises();
        return view('livewire.agregar-contacto', compact('paises'));
    }
}
