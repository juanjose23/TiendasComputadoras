@extends('layout.layouts')
@section('title', 'Perfil')
@section('submodulo', 'Perfil')

@section('content')


    <div class="row">
        <section class="col-md-4 col-xl-3">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Detalle del Perfil</h5>
                </div>
                <div class="card-body text-center">
                    @foreach ($imagenes as $imagen)
                        <img src="{{ $imagen->url }}" alt="{{ $empleados->personas->nombre }}"
                            class="img-fluid rounded-circle mb-2" width="100" height="128" />
                    @endforeach

                    @if ($imagenes->isEmpty())
                        <!-- Si no hay imágenes, mostrar la imagen predeterminada de la sesión -->
                        <img src="{{ session('Foto') }}" alt="{{ $empleados->personas->nombre }}"
                            class="img-fluid rounded-circle mb-2" width="100" height="128" />
                    @endif

                    <h5 class="card-title mb-0">{{ $empleados->personas->nombre }}
                        {{ $empleados->personas->persona_naturales->apellido }}</h5>
                    <div class="text-muted mb-2"></div>

                    <div>
                        <a href="{{ route('actualizarperfil') }}" class="btn btn-primary mb-2 me-2 btn-small">
                            <i class="fas fa-user-edit"></i> Actualizar perfil
                        </a>
                    </div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <h5 class="h6 card-title">Informacion Personal</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-1"><span data-feather="calendar" class="feather-sm me-1"></span><a
                                href="#">Fecha de nacimiento:
                                {{ $empleados->personas->persona_naturales->fecha_nacimiento }}</a></li>
                        <li class="mb-1"><span data-feather="credit-card" class="feather-sm me-1"></span><a
                                href="#">Tipo de identificación:
                                {{ $empleados->personas->persona_naturales->tipo_identificacion }}</a></li>
                        <li class="mb-1"><span data-feather="user" class="feather-sm me-1"></span><a
                                href="#">Identificación:
                                {{ $empleados->personas->persona_naturales->identificacion }}</a></li>
                        <li class="mb-1"><span data-feather="mail" class="feather-sm me-1"></span><a
                                href="#">Correo: {{ $empleados->personas->correo }}</a></li>
                        <li class="mb-1"><span data-feather="phone" class="feather-sm me-1"></span><a
                                href="#">Teléfono: {{ $empleados->personas->telefono }}</a></li>
                    </ul>
                </div>

                <hr class="my-0" />
                <div class="card-body">
                    <h5 class="h6 card-title">Informacion Adiccional</h5>
                    <ul class="list-unstyled mb-0">
                        @if (!empty($empleados->inss))
                            <li class="mb-1"><span data-feather="shield" class="feather-sm me-1"></span>Número
                                de
                                seguro social: <a>{{ $empleados->inss }}</a></li>
                        @else
                            <li class="mb-1"><span data-feather="shield" class="feather-sm me-1"></span>Número
                                de
                                seguro social: <a>Aún no se ha registrado el código INSS</a></li>
                        @endif


                        <li class="mb-1"><span data-feather="credit-card" class="feather-sm me-1"></span>Código
                            de
                            trabajador: <a>{{ $empleados->codigo }}</a></li>

                        <li class="mb-1"><span data-feather="{{ $empleados->estado ? 'check-circle' : 'x-circle' }}"
                                class="feather-sm me-1"></span>Estado: <a
                                class="badge rounded-pill {{ $empleados->estado == 1 ? 'bg-success' : 'bg-danger' }}">{{ $empleados->estado ? 'Activo' : 'Inactivo' }}</a>
                        </li>

                    </ul>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <h5 class="h6 card-title">Dirección</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-1"><span data-feather="home"
                                class="feather-sm me-1"></span>Localidad:<a>{{ $empleados->personas->direcciones[0]->municipios->nombre }}</a>
                        </li>

                        <li class="mb-1"><span data-feather="navigation" class="feather-sm me-1"></span>Dirección: <a
                                href="#">{{ $empleados->personas->direcciones[0]->direccion }}</a></li>

                        <li class="mb-1"><span data-feather="map-pin" class="feather-sm me-1"></span>País de
                            origen <a href="#">{{ $empleados->personas->persona_naturales->paises->nombre }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="col-md-8 col-xl-9">
            <div class="container-fluid p-0">
                <article class="row">
                    <div class="col-md-12 col-xl-12">
                        <div class="card">

                            <div class="card-body h-100">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <strong>Salario Actual:{{ $salario }}</strong>
                                        <br />
                                    </div>
                                </div>
                                <hr />
                                <div class="d-flex align-items-start">

                                    <div class="flex-grow-1">
                                        <strong>Cargos Actuales:</strong>
                                        <ul class="list-group mt-2">
                                            @foreach ($cargo as $item)
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <span>Cargo: {{ $item->cargos->nombre }}</span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <span>Fecha de Creación: {{ $item->created_at }}</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <hr />
                                <div class="d-grid">
                                    <a href="{{ route('exportaciones.pdf', ['colaboradores' => $empleados->id]) }}"
                                        class="btn btn-primary">Descargar pdf</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-12 ">
                        <div class="card d-flex justify-content-center">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Inicios de sesión</h5>
                            </div>
                            <div class="card-body h-100 d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <strong>Inicios activos:</strong>
                                    <div class="row g-4 mt-2">
                                        @foreach ($sessiones as $item)
                                            <div class="col-md-4">
                                                <div class="card bg-light border">
                                                    <div class="card-body">
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-3">
                                                            @if ($item->platform_name == 'Mobile')
                                                                <i class="fas fa-mobile-alt fa-2x text-primary"></i>
                                                            @else
                                                                <i class="fas fa-desktop fa-2x text-primary"></i>
                                                            @endif
                                                            <span class="text-muted">{{ $item->platform_name }}
                                                                {{ $item->browser_name }}</span>
                                                        </div>
                                                        <p class="card-text mb-0">
                                                            <strong>IP:</strong> {{ $item->ip_address }}
                                                            @if ($item->ip_address === request()->ip() && $item->user_agent === request()->header('User-Agent'))
                                                                <span class="badge rounded-pill bg-primary">Esta es la
                                                                    sesión actual </span>
                                                            @else
                                                                <strong>Actividad:</strong>
                                                                {{ \Carbon\Carbon::createFromTimeStamp($item->last_activity)->diffForHumans() }}
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @if ($sessiones->count() > 1)
                                        <form id="formCerrarSesion" action="{{ route('cerrar_sesion_dispositivo') }}"
                                            method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ session('id') }}">
                                            <!-- Este botón desencadenará el SweetAlert -->
                                            <button type="button" class="btn btn-danger mt-3"
                                                onclick="confirmAction({{ session('id') }})">
                                                <i class="fas fa-cancel"></i> Cerrar sesión en los otros dispositivos
                                            </button>
                                        </form>
                                    @endif
                                </div>

                            </div>
                        </div>

                        <div class="col-md-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">Cambiar contraseña</h5>
                                </div>
                                <div class="card-body h-100">
                                    <livewire:cambiarclave />
                                </div>
                            </div>
                        </div>


                </article>
            </div>

        </section>
    </div>
    <script>
        async function confirmAction(SessionId) {
            const {
                value: password
            } = await Swal.fire({
                title: "Ingresa tu contraseña",
                input: "password",
                inputLabel: "Contraseña",
                inputPlaceholder: "Ingresa tu contraseña",
                inputAttributes: {
                    maxlength: "10",
                    autocapitalize: "off",
                    autocorrect: "off"
                },
                inputValidator: (value) => {
                    return new Promise((resolve) => {
                        if (value.trim() === "") {
                            resolve("Debes ingresar tu contraseña");
                        } else {
                            resolve();
                        }
                    });
                },
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, cerrar todas las sesiones',
                cancelButtonText: 'Cancelar'
            });

            if (password) {
                // Si se ingresó una contraseña, proceder con el envío del formulario
                var form = document.getElementById('formCerrarSesion');
                var passwordInput = document.createElement('input');
                passwordInput.type = 'hidden';
                passwordInput.name = 'current_password';
                passwordInput.value = password;
                form.appendChild(passwordInput);
                form.submit();
            }
        }
    </script>

@endsection
