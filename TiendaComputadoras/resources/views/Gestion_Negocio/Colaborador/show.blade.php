@extends('layout.layout')
@section('title', 'Colaboradores')
@section('submodulo', 'Detalles de colaborador')
@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-md-4 col-xl-4">
                <div class="card-body mb-3">
                    <div class="text-center">
                        <img src="{{ $empleados->personas->foto }}" alt="{{ $empleados->personas->nombre }}"
                            class="img-fluid rounded-circle mb-2" width="128" height="128" />
                        <h5 class="card-title mb-0">{{ $empleados->personas->nombre }}
                            {{ $empleados->personas->persona_naturales->apellido }}</h5>
                        <div class="text-muted mb-2"></div>

                        <div>
                            <a class="btn btn-primary btn-sm mb-1"
                                href="{{ route('colaboradores.edit', ['colaboradores' => $empleados->id]) }}">Actualizar
                                Datos</a>

                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <h5 class="h6 card-title">Datos Personales y de contactos</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1"><span data-feather="calendar" class="feather-sm me-1"></span><a href="#">Fecha de nacimiento: {{$empleados->personas->persona_naturales->fecha_nacimiento}}</a></li>
                            <li class="mb-1"><span data-feather="credit-card" class="feather-sm me-1"></span><a href="#">Tipo de identificación: {{$empleados->personas->persona_naturales->tipo_identificacion}}</a></li>
                            <li class="mb-1"><span data-feather="user" class="feather-sm me-1"></span><a href="#">Identificación: {{$empleados->personas->persona_naturales->identificacion}}</a></li>
                            <li class="mb-1"><span data-feather="mail" class="feather-sm me-1"></span><a href="#">Correo: {{$empleados->personas->correo}}</a></li>
                            <li class="mb-1"><span data-feather="phone" class="feather-sm me-1"></span><a href="#">Teléfono: {{$empleados->personas->telefono}}</a></li>
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

                            <li class="mb-1"><span data-feather="navigation" class="feather-sm me-1"></span>Dirección: <a href="#">{{ $empleados->personas->direcciones[0]->direccion }}</a></li>

                            <li class="mb-1"><span data-feather="map-pin" class="feather-sm me-1"></span>País de origen <a
                                    href="#">{{ $empleados->personas->persona_naturales->paises->nombre }}</a></li>
                        </ul>
                    </div>
                   
                </div>
            </div>

            <div class="col-md-8 col-xl-8">

                <div class="card-header">

                    <h5 class="card-title mb-0">Activities</h5>
                </div>
                <div class="card-body h-100">

                    <div class="d-flex align-items-start">
                        <img src="img/avatars/avatar-5.jpg" width="36" height="36" class="rounded-circle me-2"
                            alt="Vanessa Tucker">
                        <div class="flex-grow-1">
                            <small class="float-end text-navy">5m ago</small>
                            <strong>Vanessa Tucker</strong> started following <strong>Christina Mason</strong><br />
                            <small class="text-muted">Today 7:51 pm</small><br />

                        </div>
                    </div>

                    <hr />
                    <div class="d-flex align-items-start">
                        <img src="img/avatars/avatar.jpg" width="36" height="36" class="rounded-circle me-2"
                            alt="Charles Hall">
                        <div class="flex-grow-1">
                            <small class="float-end text-navy">30m ago</small>
                            <strong>Charles Hall</strong> posted something on <strong>Christina Mason</strong>'s
                            timeline<br />
                            <small class="text-muted">Today 7:21 pm</small>

                            <div class="border text-sm text-muted p-2 mt-1">
                                Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero,
                                sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus
                                pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae
                                sapien ut libero venenatis faucibus. Nullam quis ante.
                            </div>

                            <a href="#" class="btn btn-sm btn-danger mt-1"><i class="feather-sm"
                                    data-feather="heart"></i> Like</a>
                        </div>
                    </div>

                    <hr />
                    <div class="d-flex align-items-start">
                        <img src="img/avatars/avatar-4.jpg" width="36" height="36" class="rounded-circle me-2"
                            alt="Christina Mason">
                        <div class="flex-grow-1">
                            <small class="float-end text-navy">1h ago</small>
                            <strong>Christina Mason</strong> posted a new blog<br />

                            <small class="text-muted">Today 6:35 pm</small>
                        </div>
                    </div>

                    <hr />
                    <div class="d-flex align-items-start">
                        <img src="img/avatars/avatar-2.jpg" width="36" height="36" class="rounded-circle me-2"
                            alt="William Harris">
                        <div class="flex-grow-1">
                            <small class="float-end text-navy">3h ago</small>
                            <strong>William Harris</strong> posted two photos on <strong>Christina Mason</strong>'s
                            timeline<br />
                            <small class="text-muted">Today 5:12 pm</small>

                            <div class="row g-0 mt-1">
                                <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                    <img src="img/photos/unsplash-1.jpg" class="img-fluid pe-2" alt="Unsplash">
                                </div>
                                <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                    <img src="img/photos/unsplash-2.jpg" class="img-fluid pe-2" alt="Unsplash">
                                </div>
                            </div>

                            <a href="#" class="btn btn-sm btn-danger mt-1"><i class="feather-sm"
                                    data-feather="heart"></i> Like</a>
                        </div>
                    </div>

                    <hr />
                    <div class="d-flex align-items-start">
                        <img src="img/avatars/avatar-2.jpg" width="36" height="36" class="rounded-circle me-2"
                            alt="William Harris">
                        <div class="flex-grow-1">
                            <small class="float-end text-navy">1d ago</small>
                            <strong>William Harris</strong> started following <strong>Christina Mason</strong><br />
                            <small class="text-muted">Yesterday 3:12 pm</small>

                            <div class="d-flex align-items-start mt-1">
                                <a class="pe-3" href="#">
                                    <img src="img/avatars/avatar-4.jpg" width="36" height="36"
                                        class="rounded-circle me-2" alt="Christina Mason">
                                </a>
                                <div class="flex-grow-1">
                                    <div class="border text-sm text-muted p-2 mt-1">
                                        Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec
                                        odio et ante tincidunt tempus.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr />
                    <div class="d-flex align-items-start">
                        <img src="img/avatars/avatar-4.jpg" width="36" height="36" class="rounded-circle me-2"
                            alt="Christina Mason">
                        <div class="flex-grow-1">
                            <small class="float-end text-navy">1d ago</small>
                            <strong>Christina Mason</strong> posted a new blog<br />
                            <small class="text-muted">Yesterday 2:43 pm</small>
                        </div>
                    </div>

                    <hr />
                    <div class="d-flex align-items-start">
                        <img src="img/avatars/avatar.jpg" width="36" height="36" class="rounded-circle me-2"
                            alt="Charles Hall">
                        <div class="flex-grow-1">
                            <small class="float-end text-navy">1d ago</small>
                            <strong>Charles Hall</strong> started following <strong>Christina Mason</strong><br />
                            <small class="text-muted">Yesterdag 1:51 pm</small>
                        </div>
                    </div>

                    <hr />
                    <div class="d-grid">
                        <a href="#" class="btn btn-primary">Load more</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
