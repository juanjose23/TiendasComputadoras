<?php

namespace App\Livewire;

use App\Models\contactosproveedores;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class TablaContactos extends Component
{
    public $proveedorId;

    public $contactoId;
    public $nombre;
    public $telefono;
    public $correo;
    public $cargo;
    public $estado;
    protected $rules = [
        'nombre' => 'required',
        'correo' => 'required|email|unique:personas,correo',
        'telefono' => 'required|unique:personas,telefono',
        'cargo' => 'required',
       
    ];

    protected $messages = [
        'nombre.required' => 'El nombre es obligatorio.',
        'correo.required' => 'El correo es obligatorio.',
        'correo.email' => 'El correo debe ser una dirección válida.',
        'correo.unique' => 'El correo ya está registrado.',
        'telefono.unique' => 'El correo ya está registrado.',
        'telefono.required' => 'El teléfono es obligatorio.',
        'cargo.required' => 'El cargo es obligatorio.',
       
    ];
    public function mount($proveedorId)
    {
        $this->proveedorId = $proveedorId;
    }

    use WithPagination;
    public $buscar = '';
    public $perPage = 10;

    public function render()
    {
        $buscar = $this->buscar;

        $proveedores = contactosproveedores::with(['personas'])
            ->where('proveedores_id', $this->proveedorId)
            ->whereHas('personas', function ($query) use ($buscar) {
                $query->where('telefono', 'like', '%' . $buscar . '%')
                    ->orWhere('correo', 'like', '%' . $buscar . '%')
                    ->orWhere('nombre', 'like', '%' . $buscar . '%');
            })
            ->paginate($this->perPage);

        return view('livewire.tabla-contactos', compact('proveedores'));
    }
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        $this->gotoPage(1); // Reiniciar el paginado a la página 1
    }


    #[On('eliminar-confirmacion')]
    public function confirmarEliminacion()
    {
        $this->dispatch('confirmado-eliminacion');
    }

    #[On('cambiar-estado')]
    public function cambiarEstado($Id)
    {
        $contacto = contactosproveedores::findOrFail($Id); // Usa el modelo contactosproveedores
        $contacto->estado = $contacto->estado == 1 ? 0 : 1; // Cambiar el estado
        $contacto->save();

        // Despachar evento para indicar que se cambió el estado con éxito
        $this->dispatch('estado-cambiado', 'Se ha realizado la operación con éxito');
    }

    public function editarContacto($contactoId)
    {
        // Obtener la información del contacto a editar
        $contacto = contactosproveedores::findOrFail($contactoId);

        // Llenar los campos del formulario con la información del contacto
        $this->nombre = $contacto->personas->nombre;
        $this->telefono = $contacto->personas->telefono;
        $this->correo = $contacto->personas->correo;
        $this->cargo = $contacto->cargo;

        // Guardar el ID del contacto que se está editando
        $this->contactoId = $contactoId;

        // Mostrar el modal de edición
        $this->dispatch('mostrar-modal-edicion');
    }
    #[On('cambiar-contacto')]
    public function actualizarContacto()
    {
      
        $contacto = contactosproveedores::findOrFail($this->contactoId);
        $contacto->personas->nombre = $this->nombre;
        $contacto->personas->telefono = $this->telefono;
        $contacto->personas->correo = $this->correo;
        $contacto->cargo = $this->cargo;
        $contacto->personas->save();
        $contacto->save();

        // Ocultar el modal de edición
        $this->dispatch('cerrar-modal-edicion');

        // Mostrar un mensaje de éxito (opcional)
        session()->flash('success', '¡La información del contacto se actualizó correctamente!');
    }
}
