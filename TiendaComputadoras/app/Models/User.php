<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Faker\Provider\ar_EG\Person;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
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
     *//* The `user` variable in the `validarLogin`
     method is being used to store the result of
     the `ValidarUsuario` method called on the
     `` object. This method is likely
     used to validate the user based on the
     provided username or user ID from the
     request. The result of this validation is
     then used in the subsequent line where the
     password is validated using the
     `ValidarContrasena` method. */

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
        return $this->hasMany('App\Models\RolesUsuarios', 'users_id');
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


    /**
     * Valida si el usuario existe en la base de datos y retorna su ID y el ID de la persona asociada.
     *
     * @param string $usuario El nombre de usuario a validar.
     * @return array|null Un array con el ID del usuario y el ID de la persona asociada si el usuario existe, o null si no existe.
     */
    public function ValidarUsuario($usuario)
    {
        $user = User::where('usuario', $usuario)
            ->where('estado', 1)
            ->first();


        if ($user !== null) {
            return ['id' => $user->id, 'personas_id' => $user->personas_id];
        }
        return null;
    }

    /**
     * Valida si la contraseña proporcionada es correcta para el usuario especificado.
     *
     * @param int $Id El ID del usuario.
     * @param string $contrasena La contraseña a validar.
     * @return bool True si la contraseña es válida para el usuario, False en caso contrario.
     */
    public function ValidarContrasena($Id, $contrasena)
    {
        $user = User::find($Id);
        if ($user !== null) {
            return password_verify($contrasena, $user->password);
        }
        return false;
    }

    /**
     * Obtener información detallada de un usuario.
     *
     * @param int $PersonaId El ID de la persona de la que se desea obtener la información.
     * @return array La información detallada del usuario.
     */
    public function ObtenerInformacionUsuario($PersonaId)
    {
        // Obtener la información básica de la persona
        $persona = Personas::findOrFail($PersonaId);

        // Verificar si la persona es natural o jurídica
        $personaNatural = Persona_Naturales::where('personas_id', $PersonaId)->first();
        $personaJuridica = Persona_Juridicas::where('personas_id', $PersonaId)->first();

        $apellido_razon_social = '';

        // Si existe registro en Persona_Naturales, la persona es natural
        if ($personaNatural) {

            $apellido_razon_social = $personaNatural->apellido;
        }
        // Si existe registro en Persona_Juridicas, la persona es jurídica
        elseif ($personaJuridica) {
            $apellido_razon_social = $personaJuridica->razon_social;
        }

        // Retornar la información recopilada
        return [
            'id' => $PersonaId,
            'nombre' => $persona->nombre,
            'apellido_razon_social' => $apellido_razon_social,

        ];
    }

    /**
     * Obtener IdCliente y foto
     */
    public function ObtenerCodigoCliente($Id)
    {
        return null;
    }

    /**
     * Obtener el código y la foto de un empleado.
     *
     * @param int $Id El ID de la persona asociada al empleado.
     * @return array La información del empleado.
     */
    public function ObtenerCodigoEmpleados($Id)
    {
        // Buscar el empleado con el ID de persona proporcionado
        $empleados = Empleados::where('personas_id', $Id)->first();

        // Verificar si se encontró el empleado
        if ($empleados) {

            $imagen = Imagen::where('imagenable_type', 'App\Models\Empleados')
                ->where('imagenable_id', $empleados->id)
                ->first();

          

            // Retornar la información recopilada
            return [
                'id' => $empleados->id,
                'codigo' => $empleados->codigo,
                'foto' => $imagen ? $imagen->url : null,
            ];
        } else {
            // El empleado no existe, retornar null o cualquier otro valor que indique que no se encontró el empleado
            return null;
        }
    }


    public static function hasPrivilege($UserId, $privilegeId): bool
    {
        // Ejecuta la consulta para verificar si el usuario tiene el privilegio deseado
        $result = DB::table('privilegiosroles as pr')->select('m.id AS id_modulo')
            ->join('submodulos AS sm', 'sm.id', '=', 'pr.submodulos_id')
            ->join('modulos AS m', 'm.id', '=', 'sm.modulos_id')
            ->leftJoin('rolesusuarios AS rt', 'rt.roles_id', '=', 'pr.roles_id')
            ->leftJoin('users AS u', 'rt.users_id', '=', 'u.id')
            ->where('rt.users_id', '=', $UserId)
            ->where('rt.estado', '=', 1)
            ->where('pr.submodulos_id', '=', $privilegeId)
            ->exists();
        return $result;
    }



    /**
     * 
     */
    public function ObtenerFotoPerfil()
    {
        if ($this->profile_photo_path) {
            return $this->profile_photo_path;
        }

        $initials = '';
        $names = explode(' ', $this->name);
        foreach ($names as $name) {
            $initials .= strtoupper(substr($name, 0, 1));
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($initials) . '&size=64';
    }

    


     // Obtener el token de recuerdo
     public function getRememberToken()
     {
         return $this->remember_token;
     }
 
     // Establecer el token de recuerdo
     public function setRememberToken($value)
     {
         $this->remember_token = $value;
     }
}
