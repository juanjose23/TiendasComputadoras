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
    <link rel="shortcut icon" defer href="{{ $datos['imagen']->url }}" />
    <title>Sistema @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('js/bootstrap-4.min.css') }}">
    <link href="{{ asset('css/light.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/Iconos/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        body {
            opacity: 0;
        }
    </style>
   

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

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
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


    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.buscador').select2({
                theme: 'bootstrap4'
            })
        })
    </script>
</body>

</html>
