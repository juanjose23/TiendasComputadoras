@extends('layout.layout')
@section('title', 'Productos')
@section('submodulo', 'Agregar nuevos detalles productos')
@section('content')
    <form action="{{ route('productos.guardardetalles') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="nombre" class="form-label text-dark">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre del producto"
                        class="form-control @error('nombre') is-invalid @enderror"
                        value="{{ old('nombre', $producto->nombre) }}" disabled>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <input type="text" name="productos" value="{{ $producto->id }}" hidden>
            <div class="col-md-9">
                <label for="especificaciones" class="mb-2 text-black">Especificaciones:</label>
                <ul class="especificaciones-lista">
                    <li>1.<span>Categoría:</span> {{ $producto->subcategorias->categorias->nombre }}</li>
                    <li>2.<span>Subcategoría:</span> {{ $producto->subcategorias->nombre }}</li>
                    <li>3.<span>Marca:</span> {{ $producto->modelos->marcas->nombre }}</li>
                    <li>4.<span>Modelo:</span> {{ $producto->modelos->nombre }}</li>
                </ul>
            </div>


            <!-- Campos de productos_detalles -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="color" class="form-label text-dark">Color</label>
                    <select id="color"style="width: 100%" name="color"
                        class="form-select buscador @error('color') is-invalid @enderror" style="width: 100%">
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
                    <select id="corte"style="width: 100%" name="corte"
                        class="form-select buscador @error('corte') is-invalid @enderror" style="width: 100%">
                        <option selected disabled>Seleccionar Corte</option>
                        @foreach ($cortes as $corte)
                            <option value="{{ $corte->id }}" {{ old('corte') == $corte->id ? 'selected' : '' }}>
                                {{ $corte->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('corte')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="talla" class="form-label text-dark">Tallas</label>
                    <select id="talla"style="width: 100%" name="talla"
                        class="form-select buscador @error('talla') is-invalid @enderror" style="width: 100%">
                        <option selected disabled>Seleccionar Talla</option>
                        @foreach ($tallas as $talla)
                            <option value="{{ $talla->id }}" {{ old('talla') == $talla->id ? 'selected' : '' }}>
                                {{ $talla->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('talla')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="generos" class="form-label text-dark">Genero</label>
                    <select id="generos"style="width: 100%" name="genero"
                        class="form-select buscador @error('genero') is-invalid @enderror" style="width: 100%">
                        <option selected disabled>Seleccionar Talla</option>
                        @foreach ($generos as $genero)
                            <option value="{{ $genero->id }}" {{ old('genero') == $genero->id ? 'selected' : '' }}>
                                {{ $genero->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('genero')
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

<style>
    .especificaciones-lista {
        list-style-type: none;
        padding: 0;
        color:black; 
    }

    .especificaciones-lista li {
        margin-bottom: 10px;
    }

    .especificaciones-lista li span {
        font-weight: bold;
        margin-right: 5px;
    }
</style>
