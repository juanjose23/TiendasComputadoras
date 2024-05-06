<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class Cambiarclave extends Component
{

    public $currentPassword;
    public $newPassword;
    public $newPassword_confirmation;
    protected $listeners = ['render' => 'render'];
    protected $rules = [
        'currentPassword' => 'required',
        'newPassword' => 'required|min:8|confirmed',
        'newPassword_confirmation' => 'required',
    ];

    public function changePassword()
    {
        $this->validate();

        // Obtén el usuario autenticado usando el modelo User
        $user = User::find(auth()->id());

        if ($user) {
            // Validar la contraseña actual
            if (Hash::check($this->currentPassword, $user->password)) {
                // La contraseña actual es válida, procede a cambiarla
                $user->password = Hash::make($this->newPassword);
                $user->save(); // Guarda los cambios en la base de datos

                Session::flash('success', 'Se ha actualizado la contraseña correctamente.');

                return redirect()->to('/perfil');
            } else {
                // La contraseña actual no es válida
                session()->flash('error', 'La contraseña actual no es válida.');
            }
        } else {
            // El usuario no fue encontrado
            session()->flash('error', 'Usuario no encontrado.');
        }
    }

    public function render()
    {
        return view('livewire.cambiarclave');
    }
}
