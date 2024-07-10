@extends('layout.layouts')
@section('title', 'Solicitud')
@section('submodulo', 'Solicitud de compra')
@section('content')
    <div class="row">
        <section class="col-md-12 col-xl-12">
            <div class="card mb-12">
                <div class="card-body ">
                    <form class="row"  id="formulario" method="POST"
                        enctype="multipart/form-data">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha" class="form-label text-dark">Solicitud generada por:</label>
                                <input type="text" id="fecha" name="fecha"
                                    class="form-control @error('fecha') is-invalid @enderror"
                                    value="Codigo: {{  $solicitudes->empleados->codigo  }}  Nombre:{{  $solicitudes->empleados->personas->nombre  }} {{  $solicitudes->empleados->personas->persona_naturales->apellido  }}" disabled>
                                @error('fecha')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha" class="form-label text-dark">Fecha de Entrega</label>
                                <input type="date" id="fecha" name="fecha"
                                    class="form-control @error('fecha') is-invalid @enderror"
                                    value="{{ old('fecha', $solicitudes->fecha_entrega_esperada) }}" disabled>
                                @error('fecha')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descripcion" class="form-label text-dark">Notas </label>
                                <textarea id="descripcion" name="descripcion" rows="3"
                                    class="form-control @error('descripcion') is-invalid @enderror" disabled>{{ old('descripcion', $solicitudes->notas) }}</textarea>
                                @error('descripcion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="col-md-12">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                                <a href="{{ route('solicitud.index') }}" id="cancelar-btn"
                                    class="btn btn-danger mb-2 me-md-2">Volver al inicio    </a>
                                
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </section>
        <section class="col-md-12 col-xl-12">
            <div class="card mb-12">
                <div class="card-header">
                    <h2>Lista de productos solicitados</h2>
                </div>
                <div class="card-body text-center">
                    <div class="table-responsive">
                        <table id="solicitud" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Categoria</th>
                                    <th>Subcategoria</th>
                                    <th>Producto</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Color</th>
                                    <th>Corte</th>
                                    <th>Talla</th>
                                    <th>Cantidad</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $detalles as $detalle )
                                <tr>
                                    <td>
                                        {{$detalle->productosdetalles->productos->subcategorias->categorias->nombre}}
                                    </td>
                                    <td>
                                        {{$detalle->productosdetalles->productos->subcategorias->nombre}}
                                    </td>
                                    <td>
                                        {{$detalle->productosdetalles->productos->nombre}}
                                    </td>
                                    <td>
                                        {{$detalle->productosdetalles->productos->modelos->marcas->nombre}}
                                    </td>
                                    <td>
                                        {{$detalle->productosdetalles->productos->modelos->nombre}}
                                    </td>
                                    <td>
                                        {{$detalle->productosdetalles->coloresproductos->colores->nombre}}
                                    </td>
                                    <td>
                                        {{$detalle->productosdetalles->cortesproductos->cortes->nombre}}
                                    </td>
                                    <td>
                                        {{$detalle->productosdetalles->tallasproductos->tallas->nombre}}
                                    </td>
                                    <td>
                                        {{$detalle->cantidad}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>



                </div>
            </div>
        </section>
    </div>

@endsection
