@extends('layout.layout')
@section('title', 'Perfil')
@section('submodulo', 'Perfil')

@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-md-4 col-xl-4">
                <div class="card-body mb-3">
                    <div class="text-center">
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
                            <a href="{{ route('actualizarperfil') }}" class="btn btn-primary">Actualizar perfil</a>



                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <h5 class="h6 card-title">Datos Personales y de contactos</h5>
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
                        <h5 class="h6 card-title">Datos del colaborador</h5>
                        <ul class="list-unstyled mb-0">
                            @if (!empty($empleados->inss))
                                <li class="mb-1"><span data-feather="shield" class="feather-sm me-1"></span>Número de
                                    seguro social: <a>{{ $empleados->inss }}</a></li>
                            @else
                                <li class="mb-1"><span data-feather="shield" class="feather-sm me-1"></span>Número de
                                    seguro social: <a>Aún no se ha registrado el código INSS</a></li>
                            @endif


                            <li class="mb-1"><span data-feather="credit-card" class="feather-sm me-1"></span>Código de
                                trabajador: <a>{{ $empleados->codigo }}</a></li>

                            <li class="mb-1"><span data-feather="{{ $empleados->estado ? 'check-circle' : 'x-circle' }}"
                                    class="feather-sm me-1"></span>Estado: <a
                                    class="badge rounded-pill {{ $empleados->estado == 1 ? 'bg-success' : 'bg-danger' }}">{{ $empleados->estado ? 'Activo' : 'Inactivo' }}</a>
                            </li>

                        </ul>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <h5 class="h6 card-title">Direcciones</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1"><span data-feather="home"
                                    class="feather-sm me-1"></span>Localidad:<a>{{ $empleados->personas->direcciones[0]->municipios->nombre }}</a>
                            </li>

                            <li class="mb-1"><span data-feather="navigation" class="feather-sm me-1"></span>Dirección: <a
                                    href="#">{{ $empleados->personas->direcciones[0]->direccion }}</a></li>

                            <li class="mb-1"><span data-feather="map-pin" class="feather-sm me-1"></span>País de origen <a
                                    href="#">{{ $empleados->personas->persona_naturales->paises->nombre }}</a></li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="col-md-8 col-xl-8">

                <div class="card-header">

                    <h5 class="card-title mb-0">Datos del empleados</h5>
                </div>
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
                    <hr>
                    <div class="d-flex align-items-start">

                        <div class="flex-grow-1">
                            <strong>Inicios activos:</strong>
                            <div class="table-responsive">
                                <table class="table table-striped mt-2">
                                    <thead>
                                        <tr>
                                            <th>Dirección IP</th>
                                            <th>Navegador</th>
                                            <th>Plataforma</th>
                                            <th>Actividad</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sessiones as $item)
                                            <tr>
                                                <td>{{ $item->ip_address }}</td>
                                                <td>{{ $item->browser_name }}</td>
                                                <td>{{ $item->platform_name }}</td>
                                                <td>{{ \Carbon\Carbon::createFromTimeStamp($item->last_activity)->diffForHumans() }}</td>
                                                <td>
                                                    <span class="badge rounded-pill {{ $item->active ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $item->active ? 'Activo' : 'Inactivo' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="flex me-1">
                                                        <button type="button" class="btn btn-{{ $item->active ? 'danger' : 'success' }} btn-block"
                                                            role="button" onclick="confirmAction({{ $item->id }})">
                                                            <i class="fas fa-{{ $item->active ? 'trash-alt' : 'toggle-on' }}"></i>
                                                        </button>
                                                    </div>
                                                    <form id="deleteForm{{ $item->id }}" action="{{ route('cerrar_sesion_dispositivo') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                                        <!-- Este botón no es visible, pero se utilizará para activar el SweetAlert -->
                                                        <button id="submitBtn{{ $item->id }}" type="submit" style="display: none;"></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                </div>
              
            </div>
        </div>
    </div>

@endsection
<script>
    function confirmAction(SessionId) {
        Swal.fire({
            title: '¿Estás seguro?',
            html: '<input type="password" id="password" class="swal2-input" placeholder="Contraseña">',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Confirmar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Obtener la contraseña ingresada por el usuario
                var password = document.getElementById('password').value;

                // Validar que se haya ingresado una contraseña
                if (password.trim() === '') {
                    Swal.fire('¡Error!', 'Debes ingresar tu contraseña.', 'error');
                    return;
                }

                // Agregar un campo oculto al formulario para la contraseña
                var form = document.getElementById('deleteForm' + SessionId);
                var passwordInput = document.createElement('input');
                passwordInput.type = 'hidden';
                passwordInput.name = 'current_password';
                passwordInput.value = password;
                form.appendChild(passwordInput);

                // Agregar un campo oculto para el método POST
                var methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'POST';
                form.appendChild(methodInput);

                // Enviar el formulario
                form.submit();
            }
        });
    }
</script>
