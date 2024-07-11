<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\Personas;
use App\Models\RolesUsuarios;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
class GoogleController extends Controller
{
    //
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->with(['prompt' => 'consent'])->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {

        try {
            $client = new Client();

            // Configura los datos para el intercambio de código por token
            $response = $client->post('https://oauth2.googleapis.com/token', [
                'form_params' => [
                    'code' => request('code'),
                    'client_id' => env('GOOGLE_CLIENT_ID'),
                    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
                    'redirect_uri' => env('GOOGLE_REDIRECT_URI'),
                    'grant_type' => 'authorization_code',
                ],
            ]);

            $body = json_decode((string) $response->getBody(), true);

            // Usa el token de acceso para obtener la información del usuario
            $userResponse = $client->get('https://www.googleapis.com/oauth2/v1/userinfo', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $body['access_token'],
                ],
            ]);

            $googleUser = json_decode((string) $userResponse->getBody(), true);


            $user = $this->buscarOcrearUsuario($googleUser);

            if ($user == false) {
                return redirect('/')->with('error', 'Ya existe un usuario con este correo electrónico');
            }
            $this->almacenarDatosUsuarioEnSesion($user, $googleUser);
            Auth::login($user, true);
            return redirect('/');

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // Captura el error específico de Guzzle y muestra los detalles
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            return response()->json(['error' => 'Failed to authenticate with Google', 'details' => $responseBodyAsString], 500);
        } catch (Exception $e) {
            // Captura cualquier otro tipo de error y muestra los detalles
            return response()->json(['error' => 'Failed to authenticate with Google', 'message' => $e->getMessage()], 500);
        }

    }
    protected function buscarOcrearUsuario($googleUser)
    {

        $googleId = $googleUser['id'];
        $googleNombre = $googleUser['given_name'];
        $googleApellido = $googleUser['family_name'];
        $googleEmail = $googleUser['email'];
        $googleProfile = $googleUser['picture'];
        $user = User::where('provider', 'google')
            ->where('provider_id', $googleId)
            ->first();



        if (!$user) {
            // Verificar si ya existe un usuario con el mismo correo electrónico
            $existeUser = User::where('email', $googleEmail)->first();

            // Si ya existe un usuario con el mismo correo electrónico, devuelve ese usuario
            if ($existeUser) {
                return false;
            }
            return $this->CrearNuevoUsuario($googleUser);
        }

        // Si el usuario ya existe, actualiza sus datos
        $user->email = $googleEmail;
        $user->save();

       
        // También actualiza los datos de la persona asociada si existe
        $persona = $user->persona;
        if ($persona) {
            $persona->nombre = $googleNombre;
            $persona->apellido = $googleApellido;
            $persona->save();
        }
        $imagenes = $user->imagenes;
        if ($imagenes) {
            Media::destroy($imagenes['id']);
        }

        $imagen = new Media();
        $imagen->url = $googleProfile;
        $imagen->imagenable_id = $user->id;
        $imagen->imagenable_type = get_class($user);
        $imagen->save();
        return $user;


    }

    protected function CrearNuevoUsuario($googleUser)
    {
        $googleId = $googleUser['id'];
        $googleNombre = $googleUser['given_name'];
        $googleApellido = $googleUser['family_name'];
        $googleEmail = $googleUser['email'];
        $googleProfile = $googleUser['picture'];


        $persona = new Personas();
        $persona->nombre = $googleNombre;
        $persona->apellido = $googleApellido;
        $persona->save();

        $user = new User();
        $user->personas_id = $persona->id;
        $user->provider = 'google';
        $user->provider_id = $googleId;
        $user->email = $googleEmail;
        $user->password = bcrypt(Str::random(24));
        $user->save();
        
        $userRol = new RolesUsuarios();
        $userRol->roles_id = 1;
        $userRol->users_id = $user->id;
        $userRol->estado = 1;
        $userRol->save();

        $imagen = new Media();
        $imagen->url = $googleProfile;
        $imagen->imagenable_id = $user->id;
        $imagen->imagenable_type = get_class($user);
        $imagen->save();

        return $user;
    }

    protected function almacenarDatosUsuarioEnSesion($user, $googleUser)
    {

        $googleId = $googleUser['id'];
        $googleNombre = $googleUser['given_name'];
        $googleApellido = $googleUser['family_name'];
        $googleEmail = $googleUser['email'];
        $googleProfile = $googleUser['picture'];

        Session::put('IdUser', $user->id);
        Session::put('Nombre', $googleNombre);
        Session::put('Email', $googleEmail);
        Session::put('Foto', $googleProfile);
    }
}
