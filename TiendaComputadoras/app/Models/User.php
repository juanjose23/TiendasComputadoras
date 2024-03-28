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

    public function roles()
    {
        return $this->hasMany('App\Models\RolesUsuarios');
    }

    /**
     * Genera una contraseña segura siguiendo estándares de seguridad comunes.
     *
     * @param int $longitud La longitud de la contraseña a generar (por defecto: 12).
     * @return string La contraseña generada.
     */
    public static function generarContrasenaSegura($longitud = 8)
    {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_';
        $longitudCaracteres = strlen($caracteres);
        $contrasena = '';
        for ($i = 0; $i < $longitud; $i++) {
            $indexAleatorio = mt_rand(0, $longitudCaracteres - 1);
            $contrasena .= $caracteres[$indexAleatorio];
        }

        return $contrasena;
    }
}
