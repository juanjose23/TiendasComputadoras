<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $usuarios = [
            [
                'personas_id' => 1,
                'usuario' => 'juan',
                'password' => Hash::make('12345678'),
                'estado' => 1,
            ],

        ];

        foreach ($usuarios as $usuario) {
            $user = User::create($usuario);

            // Marcar el usuario como verificado
            $user->email_verified_at = now();
            $user->save();
        }
    }
}
