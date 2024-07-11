<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sebras</title>
    <link rel="shortcut icon" defer href="{{ $empresa['imagen']->url }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/animate.css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/slick-carousel/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/slick-carousel/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="{{ asset('assets/vendors/jquery/jquery.min.js') }}"></script>

</head>

<body>
    <header class="oleez-header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href=""> <img src="{{ $empresa['imagen']->url }}" class=""
                    alt="" width="40" height="40">
                <span class="align-middle">{{ $empresa['company']->nombre }}</span></a>
            <ul class="nav nav-actions d-lg-none ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#!" data-toggle="searchModal">
                        <img src="{{ asset('assets/images/search.svg') }}" alt="search">

                    </a>
                </li>
                <li class="nav-item nav-item-cart">
                    <a class="nav-link" href="#!">
                        <span class="cart-item-count">0</span>
                        <img src="{{ asset('assets/images/shopping-cart.svg') }}" alt="cart">
                    </a>
                </li>
                <li class="nav-item dropdown d-none d-sm-block">
                    <a class="nav-link dropdown-toggle" href="#!" id="languageDropdown" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">ESP</a>
                    <div class="dropdown-menu" aria-labelledby="languageDropdown">
                        <a class="dropdown-item" href="#!">ESP</a>
                        <a class="dropdown-item" href="#!">ENG</a>
                    </div>
                </li>

            </ul>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#oleezMainNav"
                aria-controls="oleezMainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="oleezMainNav">
                <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
                    <li class="nav-item {{ Request::is('/') ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('inicios') }}">Inicio</a>
                    </li>
                    <li class="nav-item {{ Request::is('nosotros') ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('nosotros') }}">Nosotros</a>
                    </li>
                    <li class="nav-item {{ Request::is('contactos') ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('contactos') }}">Contacto</a>
                    </li>
                    <li class="nav-item {{ Request::is('shop') ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('shop') }}">Productos</a>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @else
                    @endguest


                </ul>
                <ul class="navbar-nav d-none d-lg-flex">
                    <li class="nav-item">
                        <a class="nav-link" href="#!" data-toggle="searchModal">
                            <img src="{{ asset('assets/images/search.svg') }}" alt="search">

                        </a>
                    </li>
                    <li class="nav-item nav-item-cart">
                        <a class="nav-link" href="#!">
                            <span class="cart-item-count">0</span>
                            <img src="{{ asset('assets/images/shopping-cart.svg') }}" alt="cart">
                        </a>
                    </li>
                    <li class="nav-item dropdown d-none d-sm-block">
                        <a class="nav-link dropdown-toggle" href="#!" id="languageDropdown" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">ESP</a>
                        <div class="dropdown-menu" aria-labelledby="languageDropdown">
                            <a class="dropdown-item" href="#!">ESP</a>
                            <a class="dropdown-item" href="#!">ENG</a>
                        </div>
                    </li>
                    @guest
                    @else
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><img
                                    src="{{ Session::get('Foto') }}" class="rounded-circle" alt="Foto de perfil"
                                    width="50" height="50"></a>

                            <div class="dropdown-menu rounded-0 m-0">
                                <li><a class="dropdown-item" href="{{ route('inicio') }}">Perfil</a></li>
                                <li><a class="dropdown-item" href="{{ route('inicio') }}">Mis Planes</a></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button class="dropdown-item" type="submit">Logout</button>
                                    </form>
                                </li>
                            </div>
                        </div>

                    @endguest


                </ul>
            </div>
        </nav>
    </header>

    <main class="{{ Request::is('shop') ? 'shop-page' : (Request::is('nosotros') ? 'about-page' : '') }}">
        @yield('content')
    </main>
    

    <footer class="oleez-footer wow fadeInUp">
        <div class="container">
            <div class="footer-content">
                <div class="row">
                    <div class="col-md-6">
                        <img src="https://res.cloudinary.com/dxtlbsa62/image/upload/v1716337113/productos/vucidlclxjws1alnlq65.png"
                            alt="sebras" class="footer-logo">
                        <p class="footer-intro-text">No seas tímido, ponte en contacto con nosotros y ¡crea el mundo de
                            nuevo!</p>
                        <nav class="footer-social-links">
                            <a href="#!">Fb</a>
                            <a href="#!">Tw</a>
                            <a href="#!">In</a>

                        </nav>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6 footer-widget-text">
                                <h6 class="widget-title">Telefono</h6>
                                <p class="widget-content">+505 7777-8969</p>
                            </div>
                            <div class="col-md-6 footer-widget-text">
                                <h6 class="widget-title">Correo</h6>
                                <p class="widget-content">info@sebras.site</p>
                            </div>
                            <div class="col-md-6 footer-widget-text">
                                <h6 class="widget-title">Direccion</h6>
                                <p class="widget-content">Por definirse <br>Managua, Nicararagua</p>
                            </div>
                            <div class="col-md-6 footer-widget-text">
                                <h6 class="widget-title">Horario</h6>
                                <p class="widget-content">Lunes a Viernes: 09:00 - 18:00 <br> Sábados: 11:00 - 17:00
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-text">
                <p class="mb-md-0">© 2024, Todos los derechos reservados.</p>

            </div>
        </div>
    </footer>

    <!-- Modals -->
    <!-- Off canvas social menu -->
    <nav id="offCanvasMenu" class="off-canvas-menu">
        <button type="button" class="close" aria-label="Close" data-dismiss="offCanvasMenu">
            <span aria-hidden="true">&times;</span>
        </button>
        <ul class="oleez-social-menu">
            <li>
                <a href="#!" class="oleez-social-menu-link">Facebook</a>
            </li>
            <li>
                <a href="#!" class="oleez-social-menu-link">Instagram</a>
            </li>

        </ul>
    </nav>
    <!-- Full screen search box -->
    <div id="searchModal" class="search-modal ">
        <button type="button" class="close " aria-label="Close" data-dismiss="searchModal">
            X
        </button>
        <form action="index.html" method="get" class="oleez-overlay-search-form ">
            <label for="search" class="sr-only ">Buscar</label>
            <input type="search" class="oleez-overlay-search-input " id="search" name="search"
                placeholder="Buscar Ahora">
        </form>
    </div>
    <script src="{{ asset('assets/vendors/popper.js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/wowjs/wow.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/slick-carousel/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/landing.js') }}"></script>
    <script>
        new WOW({
            mobile: false
        }).init();
    </script>

</body>


</html>
