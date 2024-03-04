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

                    <h5 class="card-title mb-0">Datos de Recursos humanos</h5>
                </div>
                <div class="card-body h-100">
                    <div class="d-flex align-items-start">

                        <div class="flex-grow-1">

                            <strong>Salario Actual:{{ $salario->salario }}</strong>
                            <br />

                            <hr />
                            <strong>Historial de salarios:</strong>
                            <div class="border rounded p-3 mt-3">
                                <h5 class="text-muted mb-3">Historial de Salarios</h5>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Salario</th>
                                                <th>Fecha de Creación</th>
                                                <th>Última Actualización</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($historial as $item)
                                                <tr>
                                                    <td>{{ $item->salario }}</td>
                                                    <td>{{ $item->created_at }}</td>
                                                    <td>{{ $item->updated_at }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>



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
                    <div class="d-flex align-items-start">
                        <strong>Cargos que ha ejercido:</strong>
                    </div>
                    <div class="flex-grow-1">
                        <div class="border text-sm text-muted p-2 mt-1">
                            <strong>Cargos Actuales:</strong>
                            <div class="table-responsive mt-2">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Cargo</th>
                                            <th>Fecha de Creación</th>
                                            <th>Última Actualización</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cargos as $cargo)
                                            <tr>
                                                <td>{{ $cargo->cargos->nombre }}</td>
                                                <td>{{ $cargo->created_at }}</td>
                                                <td>{{ $cargo->updated_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <hr />
                    <div class="d-grid">
                        <a href="{{ route('exportaciones.pdf', ['colaboradores' => $empleados->id]) }}" class="btn btn-primary">Descargar pdf</a>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
