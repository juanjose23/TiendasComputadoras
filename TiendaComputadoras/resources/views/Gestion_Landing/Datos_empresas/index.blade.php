@extends('layout.layouts')
@section('title', 'Empresa')
@section('submodulo', 'Acerca de la empresa')
@section('content')


    <div class="row">
        <section class="col-md-6 col-xl-3">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Detalle de la empresa</h5>
                </div>
                <div class="card-body text-center">
                    @foreach ($imagenes as $imagen)
                        <img src="{{ $imagen->url }}" alt="{{ $persona->nombre }}"
                            class="img-fluid rounded-circle mb-2" width="100" height="128" />
                    @endforeach

                    @if ($imagenes->isEmpty())
                        <!-- Si no hay imágenes, mostrar la imagen predeterminada de la sesión -->
                        <img src="https://ui-avatars.com/api/?name={{ $persona->nombre }}"
                            alt="{{ $persona->nombre }}" class="img-fluid rounded-circle mb-2" width="100"
                            height="128" />
                    @endif

                    <h5 class="card-title mb-0">{{ $persona->nombre }}
                      
                    </h5>
                    <div class="text-muted mb-2"></div>

                    
                </div>
                <hr class="my-0" />
              

                <hr class="my-0" />
                <div class="card-body">
                    <h5 class="h6 card-title">Dirección</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-1"><span data-feather="home"
                                class="feather-sm me-1"></span>Localidad:<a>{{ $persona->direcciones[0]->municipios->nombre }}</a>
                        </li>

                        <li class="mb-1"><span data-feather="navigation" class="feather-sm me-1"></span>Dirección: <a
                                href="#">{{ $persona->direcciones[0]->direccion }}</a></li>

                        
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
                                        <strong>Datos:</strong>
                                        <br />
                                        <span class="text-muted">Teléfono:</span> {{$persona->telefono}}<br>
                                        <span class="text-muted">Correo:</span> {{$persona->correo}}<br>
                                        <span class="text-muted">Razón Social:</span> {{$persona->persona_juridicas->razon_social}}<br>
                                        <span class="text-muted">RUC:</span> {{$persona->persona_juridicas->ruc}}<br>
                                        <span class="text-muted">Fecha de Constitución:</span> {{$persona->persona_juridicas->fecha_constitucional}}<br>
                                    </div>
                                </div>
                               
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Actualizar detalles de la empresa</h5>
                            </div>
                            <div class="card-body h-100">
                                <a href="{{route('empresa.edit',$persona->id)}}" class="btn btn-primary mb-3" >Agregar detalle</a>
                               
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
