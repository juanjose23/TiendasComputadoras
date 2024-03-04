@extends('layout.layout')
@section('title', 'Categorias')
@section('submodulo', 'Categorias ')
@section('content')
    <div class="card-header bg-primary text-black">
        <h2 class="card-title text-black">Detalles de la Categoría</h2>
    </div>
    <div class="">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="empleado" class="form-label text-dark">Categoría:</label>
                    <input type="text" class="form-control" value="{{ $categoria->nombre }}" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="empleado" class="form-label text-dark">Estado:</label>
                    <input type="text" class="form-control" value="{{ $categoria->estado == 1 ? 'Activo' : 'Inactivo' }}" disabled>

                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="descripcion" class="form-label text-dark">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" rows="3" class="form-control" disabled>{{ $categoria->descripcion }}</textarea>
                </div>
            </div>
        </div>

        <h3 class="mb-3">Lista de Subcategorías asignadas ala categoria</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subcategorias as $index => $subcategoria)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $subcategoria->nombre }}</td>
                            <td>{{ $subcategoria->descripcion }}</td>
                            <td>
                                <span
                                    class="badge rounded-pill {{ $subcategoria->estado == 1 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $subcategoria->estado == 1 ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-end">
        <a href="{{ route('categorias.index') }}" class="btn btn-danger">Volver al inicio</a>
    </div>
@endsection
