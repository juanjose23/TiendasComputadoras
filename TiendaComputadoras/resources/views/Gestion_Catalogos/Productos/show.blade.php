@extends('layout.layout')

@section('title', 'Productos')
@section('submodulo', 'Detalles de productos')
@section('content')
    <div class="tab">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" href="#icon-tab-1" data-bs-toggle="tab" role="tab" aria-selected="true">
                    <i class="bi bi-file-earmark-text"></i> <!-- Icono de Bootstrap -->
                    Datos generales
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" href="#icon-tab-2" data-bs-toggle="tab" role="tab" aria-selected="false"
                    tabindex="-1">
                    <i class="bi bi-palette"></i> <!-- Icono de Font Awesome -->
                    Variantes de colores
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" href="#icon-tab-3" data-bs-toggle="tab" role="tab" aria-selected="false"
                    tabindex="-1">
                    <i class="bi bi-images"></i> <!-- Icono de Bootstrap -->
                    Administración de imágenes
                </a>
            </li>

        </ul>
        <div class="tab-content">
            <div class="tab-pane active show" id="icon-tab-1" role="tabpanel">
                <h4 class="tab-title">Datos generales del producto {{ $productos->nombre }}</h4>
                <div class="col-xl-12">
                    <div class="">
                        <div class="card-header">
                            <div class="card-actions float-end">
                                <div class="dropdown position-relative">
                                    <a href="{{route('productos.index')}}"
                                    class=" btn btn-danger">
                                        <i class="bi bi-house"></i>  volver al inicio
                                    </a>

                                    
                                </div>
                            </div>
                            <h5 class="card-title mb-0 text-black text-center">Producto {{$productos->nombre}}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-0">
                             
                                <div class="col-sm-9 col-xl-12 col-xxl-9">
                                    <strong>Descripcion</strong>
                                    <p>{{$productos->descripcion}}</p>
                                </div>
                            </div>

                            <table class="table table-sm mt-2 mb-4">
                                <tbody>
                                    <tr>
                                        <th>Codigo:</th>
                                        <td>{{$productos->codigo}}</td>
                                    </tr>
                                    <tr>
                                        <th>Categoría:</th>
                                        <td>{{$productos->subcategorias->categorias->nombre}}</td>
                                    </tr>
                                    <tr>
                                        <th>Subcategoría:</th>
                                        <td>{{$productos->subcategorias->nombre}}</td>
                                    </tr>
                                    <tr>
                                        <th>Marca:</th>
                                        <td>{{$productos->modelos->marcas->nombre}}</td>
                                    </tr>
                                    <tr>
                                        <th>Modelo:</th>
                                        <td>{{$productos->modelos->nombre}}</td>
                                    </tr>
                                    <tr>
                                        <th>Estado:</th>
                                        <td><span class="badge rounded-pill {{ $productos->estado == 1 ? 'bg-success' : 'bg-danger' }}">
                                            {{ $productos->estado == 1 ? 'Activo' : 'Inactivo' }}
                                        </span></td>
                                    </tr>
                                    <tr>
                                        <th>Fecha de lanzamiento:</th>
                                        <td>{{$productos->fecha_lanzamiento}}</td>
                                    </tr>
                                    <tr>
                                        <th>Fecha de registro:</th>
                                        <td>{{$productos->created_at}}</td>
                                    </tr>
                                    <tr>
                                        <th>Fecha de actualización:</th>
                                        <td>{{$productos->updated_at}}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="">
                                <div class="card-body">
                                    <h5 class="card-title">Detalles del producto</h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <i class="bi bi-badge-8k"></i>


                                            <strong>Peso:</strong> {{$productos->detalles->peso}}
                                        </li>
                                        <li class="list-group-item">
                                            <i class="bi bi-tools me-2"></i>
                                            <strong>Materiales:</strong> {{$productos->detalles->material}}
                                        </li>
                                        <li class="list-group-item">
                                          
                                            <i class="bi bi-crop"></i>

                                            <strong>Dimensiones:</strong> {{$productos->detalles->dimensiones}}
                                        </li>
                                        <li class="list-group-item">
                                            <i class="bi bi-link-45deg me-2"></i>
                                            <strong>Compatibilidad:</strong> {{$productos->detalles->compatibilidad}}
                                        </li>
                                        <li class="list-group-item">
                                            <i class="bi bi-hand-thumbs-up me-2"></i>
                                            <strong>Instrucciones de cuidado:</strong> {{$productos->detalles->instrucciones_cuidado}}
                                        </li>
                                        <li class="list-group-item">
                                            <i class="bi bi-tools me-2"></i>
                                            <strong>Instrucciones de montaje:</strong> {{$productos->detalles->instrucciones_montaje}}
                                        </li>
                                        <li class="list-group-item">
                                            <i class="bi bi-ticket-detailed"></i>
                                            <strong>Características especiales:</strong> {{$productos->detalles->caracteristicas_especiales}}
                                        </li>
                                    </ul>
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="icon-tab-2" role="tabpanel">
                <h4 class="tab-title">Another one</h4>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor tellus eget
                    condimentum
                    rhoncus. Aenean massa. Cum sociis natoque penatibus et magnis neque dis parturient montes, nascetur
                    ridiculus mus.
                </p>
                <p>Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                    Donec pede
                    justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a,
                    venenatis vitae,
                    justo.</p>
            </div>
            <div class="tab-pane" id="icon-tab-3" role="tabpanel">
                <h4 class="tab-title">One more</h4>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor tellus eget
                    condimentum
                    rhoncus. Aenean massa. Cum sociis natoque penatibus et magnis neque dis parturient montes, nascetur
                    ridiculus mus.
                </p>
                <p>Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                    Donec pede
                    justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a,
                    venenatis vitae,
                    justo.</p>
            </div>
        </div>
    </div>
@endsection
