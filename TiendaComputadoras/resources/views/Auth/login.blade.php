<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <link rel="canonical" href="" />

    <title>Iniciar Session</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('js/bootstrap-4.min.css')}}">
</head>

<body>
    <main class="d-flex w-100"
        style="background-image: url('https://img1.wallspic.com/crops/4/7/9/4/7/174974/174974-de_colores-explosion-petalo-morado-violeta-3840x2160.jpg'); background-size: cover; background-position: center; position: relative;">
        <div class="container d-flex flex-column">
            <div class="row vh-100 justify-content-center align-items-center">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h2 text-center mb-4">Iniciar sesión</h1>
                            <form action="{{ route('validarLogin') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Usuario</label>
                                    <input class="form-control" type="text" name="usuario"
                                        placeholder="Ingresa tu correo electrónico" value="{{ old('usuario') }}">
                                    @error('usuario')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Contraseña</label>
                                    <input class="form-control" type="password" name="password"
                                        placeholder="Ingresa tu contraseña" value="{{ old('password') }}">
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" value="" id="remember-me"
                                        name="recordar">
                                    <label class="form-check-label" for="remember-me">
                                        Recordarme
                                    </label>
                                </div>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary btn-lg" type="submit">Iniciar sesión</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="text-center text-white mt-3">
                        ¿Has olvidado tu contraseña? <a href="">Recuperar</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{asset('js/sweetalert2.min.js')}}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '{{ Session::get('success') }}',
                    confirmButtonText: 'Aceptar'
                });
            @endif
            @if (Session::has('error'))
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: '{{ Session::get('error') }}',
                    confirmButtonText: 'Aceptar'
                });
            @endif
        });
    </script>
</body>

</html>
