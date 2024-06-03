@extends('layout.layouts')
@section('title', 'Proveedor')
@section('submodulo', 'Acerca del proveedor')
@section('content')


    <div class="row">
        <section class="col-md-5 col-xl-3">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Detalle del proveedor</h5>
                </div>
                <div class="card-body text-center">
                    @foreach ($imagenes as $imagen)
                        <img src="{{ $imagen->url }}" alt="{{ $proveedores->personas->nombre }}"
                            class="img-fluid rounded-circle mb-2" width="100" height="128" />
                    @endforeach

                    @if ($imagenes->isEmpty())
                        <!-- Si no hay imágenes, mostrar la imagen predeterminada de la sesión -->
                        <img src="https://ui-avatars.com/api/?name={{ $proveedores->personas->nombre }}"
                            alt="{{ $proveedores->personas->nombre }}" class="img-fluid rounded-circle mb-2" width="100"
                            height="128" />
                    @endif

                    <h5 class="card-title mb-0">{{ $proveedores->personas->nombre }}
                        {{ isset($proveedores->personas->persona_naturales->apellido) ? $proveedores->personas->persona_naturales->apellido : $proveedores->personas->persona_juridicas->razon_social }}
                    </h5>
                    <div class="text-muted mb-2"></div>


                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <h5 class="h6 card-title">Informacion Primaria</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-1"><span data-feather="calendar" class="feather-sm me-1"></span><a
                                href="#">Fecha de constitucion:
                                {{ isset($proveedores->personas->persona_naturales->fecha_nacimiento) ? $proveedores->personas->persona_naturales->fecha_nacimiento : $proveedores->personas->persona_juridicas->fecha_constitucional }}</a>
                        </li>
                        <li class="mb-1"><span data-feather="credit-card" class="feather-sm me-1"></span><a
                                href="#">Tipo de identificación:
                                {{ isset($proveedores->personas->persona_naturales->tipo_identificacion) ? $proveedores->personas->persona_naturales->tipo_identificacion : 'RUC' }}</a>
                        </li>
                        <li class="mb-1"><span data-feather="user" class="feather-sm me-1"></span><a
                                href="#">Identificación:
                                {{ isset($proveedores->personas->persona_naturales->identificacion) ? $proveedores->personas->persona_naturales->identificacion : $proveedores->personas->persona_juridicas->ruc }}</a>
                        </li>
                        <li class="mb-1"><span data-feather="mail" class="feather-sm me-1"></span><a
                                href="#">Correo: {{ $proveedores->personas->correo }}</a></li>
                        <li class="mb-1"><span data-feather="phone" class="feather-sm me-1"></span><a
                                href="#">Teléfono: {{ $proveedores->personas->telefono }}</a></li>
                        <li class="mb-1"><span data-feather="phone" class="feather-sm me-1"></span><a
                                href="#">Teléfono: {{ $proveedores->telefono }}</a></li>

                        <li class="mb-1"><span data-feather="{{ $proveedores->estado ? 'check-circle' : 'x-circle' }}"
                                class="feather-sm me-1"></span>Estado: <a
                                class="badge rounded-pill {{ $proveedores->estado == 1 ? 'bg-success' : 'bg-danger' }}">{{ $proveedores->estado ? 'Activo' : 'Inactivo' }}</a>
                        </li>
                    </ul>
                </div>

                <hr class="my-0" />
                <div class="card-body">
                    <h5 class="h6 card-title">Dirección</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-1"><span data-feather="home"
                                class="feather-sm me-1"></span>Localidad:<a>{{ $proveedores->personas->direcciones[0]->municipios->nombre }}</a>
                        </li>

                        <li class="mb-1"><span data-feather="navigation" class="feather-sm me-1"></span>Dirección: <a
                                href="#">{{ $proveedores->personas->direcciones[0]->direccion }}</a></li>

                        <li class="mb-1"><span data-feather="map-pin" class="feather-sm me-1"></span>País de
                            origen <a href="#">{{ $proveedores->paises->nombre }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="col-md-7 col-xl-9">
            <div class="container-fluid p-0">
                <article class="row">
                    <div class="col-md-12 col-xl-12">
                        <div class="card">

                            <div class="card-body h-100">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <strong>Estadisticas:</strong>
                                        <br />
                                    </div>
                                </div>
                                <hr />
                                <div class="d-flex align-items-start">

                                    <div class="flex-grow-1">
                                        <div class="col-md-11 col-sm-12">
                                            <strong>Lista de contactos:</strong>

                                            <livewire:Tabla-Contactos :proveedorId="$proveedores->id" />
                                        </div>


                                    </div>
                                </div>
                                <hr />

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Detalles del contacto</h5>
                            </div>
                            <div class="card-body h-100">
                                <button class="btn btn-primary mb-3" id="toggleForm">Agregar Nuevo Contacto</button>
                                <!-- Formulario oculto -->
                                <div id="contactForm" style="display: none;">
                                    <livewire:agregar-contacto :proveedorId="$proveedores->id" />
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

        </section>
    </div>
    <script>
        // Obtener elementos del DOM
        const toggleFormButton = document.getElementById('toggleForm');
        const contactForm = document.getElementById('contactForm');

        // Función para mostrar u ocultar el formulario y ocultar el botón
        function toggleForm() {
            if (contactForm.style.display === 'none') {
                contactForm.style.display = 'block';
                toggleFormButton.style.display = 'none'; // Ocultar el botón
            } else {
                contactForm.style.display = 'none';
                toggleFormButton.style.display = 'block'; // Mostrar el botón
            }
        }

        // Agregar evento de clic al botón para mostrar/ocultar el formulario
        toggleFormButton.addEventListener('click', toggleForm);
    </script>
@endsection
