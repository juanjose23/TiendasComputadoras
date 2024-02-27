<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="">
    <link rel="preconnect" defer href="https://fonts.gstatic.com" rel="stylesheet">
    <link rel="shortcut icon" defer href="img/icons/icon-48x48.png" />
    <title>Sistema @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link defer href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link defer href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link defer rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet">

</head>

<body>
    <div class="wrapper">
        @include('layout.sidebar')
        <div class="main">
            @include('layout.header')
            <main class="content">
                <div class="container-fluid p-0">
                    <h3 class="h3 mb-3">@yield('submodulo')</h3>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0 text-black">@yield('lista')</h5>
                                </div>
                                <div class="card-body">

                                    @yield('content')

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            @include('layout.footer')
        </div>

    </div>

    <script defer src="{{ asset('js/app.js') }}"></script>
    <link defer href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <script async>
        document.addEventListener('DOMContentLoaded', function() {
            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '{{ Session::get('success') }}',
                    confirmButtonText: 'Aceptar'
                });
            @endif
        });
    </script>
    <!-- Utiliza una versión específica de jQuery y carga de forma asíncrona -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Carga de forma asíncrona y desde un CDN -->

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>

    <script>
        $(document).ready(function() {
            $('.buscador').select2({
                width: 'resolve' // o puedes usar un valor numérico si prefieres un ancho fijo
            });
        });
    </script>
</body>

</html>
