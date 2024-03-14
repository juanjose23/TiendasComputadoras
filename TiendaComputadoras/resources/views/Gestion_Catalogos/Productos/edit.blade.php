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
            <!-- Campos de productos_detalles -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="dimensiones" class="form-label text-dark">Dimensiones</label>
                    <input type="text" id="dimensiones" name="dimensiones" placeholder="Dimensiones"
                        class="form-control @error('dimensiones') is-invalid @enderror" value="{{ old('dimensiones',$productos->detalles->dimensiones) }}">
                    @error('dimensiones')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="peso" class="form-label text-dark">Peso</label>
                    <input type="number" step="0.01" id="peso" name="peso" placeholder="Peso"
                        class="form-control @error('peso') is-invalid @enderror" value="{{ old('peso',$productos->detalles->peso) }}">
                    @error('peso')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="material" class="form-label text-dark">Material</label>
                    <input type="text" id="material" name="material" placeholder="Material"
                        class="form-control @error('material') is-invalid @enderror" value="{{ old('material',$productos->detalles->material) }}">
                    @error('material')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group">
                    <label for="instrucciones_cuidado" class="form-label text-dark">Instrucciones de Cuidado</label>
                    <textarea id="instrucciones_cuidado" name="instrucciones_cuidado" rows="3"
                        class="form-control @error('instrucciones_cuidado') is-invalid @enderror">{{ old('instrucciones_cuidado',$productos->detalles->instrucciones_cuidado) }}</textarea>
                    @error('instrucciones_cuidado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="instrucciones_montaje" class="form-label text-dark">Instrucciones de Montaje</label>
                    <textarea id="instrucciones_montaje" name="instrucciones_montaje" rows="3"
                        class="form-control @error('instrucciones_montaje') is-invalid @enderror">{{ old('instrucciones_montaje',$productos->detalles->instrucciones_montaje) }}</textarea>
                    @error('instrucciones_montaje')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="caracteristicas_especiales" class="form-label text-dark">Características
                        Especiales</label>
                    <textarea id="caracteristicas_especiales" name="caracteristicas_especiales" rows="3"
                        class="form-control @error('caracteristicas_especiales') is-invalid @enderror">{{ old('caracteristicas_especiales',$productos->detalles->caracteristicas_especiales) }}</textarea>
                    @error('caracteristicas_especiales')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="compatibilidad" class="form-label text-dark">Compatibilidad</label>
                    <textarea id="compatibilidad" name="compatibilidad" rows="3"
                        class="form-control @error('compatibilidad') is-invalid @enderror">{{ old('compatibilidad',$productos->detalles->compatibilidad) }}</textarea>
                    @error('compatibilidad')
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
