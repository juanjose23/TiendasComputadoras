@extends('layout.layout')
@section('title', 'Productos')
@section('submodulo', 'Productos')
@section('content')
    <form action="{{ route('productos.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nombre" class="form-label text-dark">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre del producto"
                        class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}">
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="estado" class="form-label text-dark">Estado</label>
                    <select id="estado" name="estado" class="form-select @error('estado') is-invalid @enderror">
                        <option selected disabled>Seleccionar estado</option>
                        <option value="1" {{ old('estado') == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="subcategoria" class="form-label text-dark">Categorias</label>
                    <select id="subcategoria" name="subcategoria"
                        class="form-select buscador @error('subcategoria') is-invalid @enderror" style="width: 100%">
                        <option selected disabled>Seleccionar Categoria</option>
                        @foreach ($subcategorias as $categorias => $sub)
                            <optgroup label="{{ $categorias }}">
                                @foreach ($sub as $subs)
                                    <option value="{{ $subs['id'] }}"
                                        {{ old('subcategoria') == $subs['id'] ? 'selected' : '' }}>
                                        {{ $subs['nombre'] }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    @error('subcategoria')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="modelo" class="form-label text-dark">Marca / modelo</label>
                    <select id="modelo" name="modelo"
                        class="buscador form-select @error('modelo') is-invalid @enderror" style="width: 100%">
                        <option selected disabled>Seleccionar Modelo</option>
                        @foreach ($modelos as $model => $modelos)
                            <optgroup label="{{ $model }}">
                                @foreach ($modelos as $modelo)
                                    <option value="{{ $modelo['id'] }}"
                                        {{ old('modelo') == $modelo['id'] ? 'selected' : '' }}>
                                        {{ $modelo['nombre'] }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    @error('modelo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
           
            <div class="col-md-4">
                <div class="form-group">
                    <label for="fecha" class="form-label text-dark">Fecha de lanzamiento</label>
                    <input type="date" id="fecha" name="fecha" placeholder="fecha de lanzamiento"
                        class="form-control @error('fecha') is-invalid @enderror" value="{{ old('fecha') }}">
                    @error('fecha')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Campos de productos_detalles -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="color" class="form-label text-dark">Color</label>
                    <select id="color"style="width: 100%" name="color" class="form-select buscador @error('color') is-invalid @enderror">
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
                    <select id="corte"style="width: 100%" name="corte" class="form-select buscador @error('corte') is-invalid @enderror">
                        <option selected disabled>Seleccionar Corte</option>
                        @foreach ($cortes as $corte)
                            <option value="{{ $corte->id }}" {{ old('corte') == $corte->id ? 'selected' : '' }}>
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
                    <select id="talla"style="width: 100%" name="talla" class="form-select buscador @error('talla') is-invalid @enderror">
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
                    <label for="genero" class="form-label text-dark">Genero</label>
                    <select id="genero"style="width: 100%" name="genero" class="form-select buscador @error('genero') is-invalid @enderror">
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
                <div class="form-group">
                    <label for="descripcion" class="form-label text-dark">Descripción</label>
                    <textarea id="descripcion" name="descripcion" rows="3"
                        class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
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
