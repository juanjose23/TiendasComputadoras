@extends('layout.layout')
@section('title', 'Productos')
@section('submodulo', 'Agregar nuevos detalles productos')
@section('content')
    <form action="{{ route('productos.guardardetalles') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nombre" class="form-label text-dark">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre del producto"
                        class="form-control @error('nombre') is-invalid @enderror"
                        value="{{ old('nombre', $producto->nombre) }}">
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <input type="text" name="productos" value="{{$producto->id}}" hidden>
            <div class="col-md-4">
                <label for="especificaciones" class="mb-2">Especificaciones:</label>
                <textarea id="especificaciones" class="form-control" rows="6" readonly>
                    {{ $producto->subcategorias->categorias->nombre }}
                    {{ $producto->subcategorias->nombre }}
                    {{ $producto->modelos->marcas->nombre }}
                    {{ $producto->modelos->nombre }}
                </textarea>
            </div>
            
            <!-- Campos de productos_detalles -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="color" class="form-label text-dark">Color</label>
                    <select id="color"style="width: 100%" name="color"
                        class="form-select buscador @error('color') is-invalid @enderror">
                        <option selected disabled>Seleccionar color</option>
                        @foreach ($colores as $color)
                            <option value="{{ $color->id }}" {{ old('color') == $color->id ? 'selected' : '' }}>
                                {{ $color->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('color')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="corte" class="form-label text-dark">Cortes</label>
                    <select id="corte"style="width: 100%" name="cortes"
                        class="form-select buscador @error('cortes') is-invalid @enderror">
                        <option selected disabled>Seleccionar Corte</option>
                        @foreach ($cortes as $corte)
                            <option value="{{ $corte->id }}" {{ old('cortes') == $corte->id ? 'selected' : '' }}>
                                {{ $corte->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('cortes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="talla" class="form-label text-dark">Tallas</label>
                    <select id="talla"style="width: 100%" name="tallas"
                        class="form-select buscador @error('tallas') is-invalid @enderror">
                        <option selected disabled>Seleccionar Talla</option>
                        @foreach ($tallas as $talla)
                            <option value="{{ $talla->id }}" {{ old('tallas') == $talla->id ? 'selected' : '' }}>
                                {{ $talla->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('tallas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="generos" class="form-label text-dark">Genero</label>
                    <select id="generos"style="width: 100%" name="generos"
                        class="form-select buscador @error('generos') is-invalid @enderror">
                        <option selected disabled>Seleccionar Talla</option>
                        @foreach ($generos as $genero)
                            <option value="{{ $genero->id }}" {{ old('genero') == $genero->id ? 'selected' : '' }}>
                                {{ $genero->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('generos')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                    <a href="{{ route('productos.index') }}" class="btn btn-danger mb-2 me-md-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary mb-2">Registrar</button>
                </div>
            </div>
        </div>
    </form>

@endsection
