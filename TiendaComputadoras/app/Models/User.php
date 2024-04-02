<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /* The code snippet you provided is from a PHP class representing a User model in a Laravel
application. Let's break down what each part is doing: */

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'usuario',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function personas()
    {
        return $this->belongsTo('App\Models\Personas');
    }

    public function rolesusuarios()
    {
        return $this->hasMany('App\Models\RolesUsuarios','users_id');
    }

    /**
     * Genera un nombre de usuario único combinando el nombre y el apellido de una persona.
     *
     * @param int $idPersona El ID de la persona.
     * @return string|null El nombre de usuario generado o null si no se puede generar.
     */
    public function generarNombreusuarios($idPersona)
    {
        $persona = Personas::find($idPersona);
        $apellido = Persona_Naturales::find($idPersona)->apellido;

        if ($persona && $apellido) {
            $nombreUsuario = strtolower(substr($persona->nombre, 0, 1) . $apellido);
            // Reemplaza los espacios por guiones bajos
            $nombreUsuario = str_replace(' ', '_', $nombreUsuario);

            $contador = 1;
            $nombreUsuarioOriginal = $nombreUsuario;

            // Verifica si el nombre de usuario ya existe en la base de datos
            while (User::where('usuario', $nombreUsuario)->exists()) {
                $nombreUsuario = $nombreUsuarioOriginal . $contador++;
            }

            return $nombreUsuario;
        }

        return null;
    }



    /**
     * Genera una contraseña segura siguiendo estándares de seguridad comunes.
     *
     * @param int $longitud La longitud de la contraseña a generar (por defecto: 12).
     * @return string La contraseña generada.
     */
    public static function generarContrasenaSegura()
    {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $longitud_caracteres = strlen($caracteres);
        $contraseña = '';

        for ($i = 0; $i < 8; $i++) {
            $indice_aleatorio = mt_rand(0, $longitud_caracteres - 1);
            $contraseña .= $caracteres[$indice_aleatorio];
        }

        return $contraseña;
    }
}
