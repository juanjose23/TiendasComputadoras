@extends('layout.layout')
@section('title', 'Productos')
@section('submodulo', 'Actualizar Productos')
@section('content')
    <form action="{{ route('productos.update',$productos->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nombre" class="form-label text-dark">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre del producto"
                        class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre',$productos->nombre) }}">
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
                        <option value="1" {{ old('estado',$productos->estado) == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('estado',$productos->estado) == '0' ? 'selected' : '' }}>Inactivo</option>
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
                                        {{ old('subcategoria',$productos->subcategorias_id) == $subs['id'] ? 'selected' : '' }}>
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
                                        {{ old('modelo',$productos->modelos_id) == $modelo['id'] ? 'selected' : '' }}>
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
                    class="form-control @error('fecha') is-invalid @enderror"
                    value="{{ old('fecha', \Carbon\Carbon::parse($productos->fecha_lanzamiento)->format('Y-m-d')) }}">
             
                    @error('fecha')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="col-md-12">
                <div class="form-group">
                    <label for="descripcion" class="form-label text-dark">Descripción</label>
                    <textarea id="descripcion" name="descripcion" rows="3"
                        class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion',$productos->descripcion) }}</textarea>
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
