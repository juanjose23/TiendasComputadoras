@extends('layout.layout')
@section('title', 'Productos')
@section('submodulo', 'Registrar Precios')
@section('content')
    <form action="{{ route('modelos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="producto" class="form-label text-dark">Productos</label>
                    <select id="producto" name="producto"
                        class="form-select buscador @error('producto') is-invalid @enderror">
                        <option selected disabled>Elegir Productos</option>
                        @foreach ($productos as $categorias => $subcategoria)
                            <optgroup label="{{ $categorias }}">
                                @foreach ($subcategoria as $productos => $producto)
                            <optgroup label="{{ $productos }}">
                                @foreach ($producto as $producto)
                                    <option value="{{ $producto['id'] }}"
                                        {{ old('producto') == $producto['id'] ? 'selected' : '' }}>
                                        Producto:{{ $producto['nombre'] }} Marca:{{ $producto['marca'] }} Modelo:
                                        {{ $producto['modelo'] }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                        </optgroup>
                        @endforeach
                    </select>
                    @error('producto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="precio" class="form-label text-dark">Precio:</label>
                    <input type="number" id="precio" name="precio" placeholder="Escribe el precio"
                        class="form-control @error('precio') is-invalid @enderror" value="{{ old('precio') }}">
                    @error('precio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="estado" class="form-label text-dark">Estado</label>
                    <select id="estado" name="estado" class="form-select @error('estado') is-invalid @enderror">
                        <option selected disabled>Elegir estado</option>
                        <option value="1" {{ old('estado') == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="terminos" class="form-check text-dark">
                        <input type="radio" id="terminos" name="terminos" class="form-check-input" value="1" {{old('terminos')=='true'? 'selected':''}} required>
                        <span class="form-check-label">
                            ¿Establecer este precio para todas la variantes de colores del productos?
                        </span>
                    </label>
                    @error('terminos')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>
            </div>


            <div class="col-md-12">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                    <a href="{{ route('modelos.index') }}" class="btn btn-danger mb-2 me-md-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary mb-2">Registrar</button>
                </div>

            </div>
        </div>
    </form>

@endsection
