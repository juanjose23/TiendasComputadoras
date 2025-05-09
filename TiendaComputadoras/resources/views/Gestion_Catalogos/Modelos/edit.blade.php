@extends('layout.layout')
@section('title', 'Modelos')
@section('submodulo', 'Actualizar Modelos')
@section('content')
    <form action="{{ route('modelos.update', $modelos) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nombre" class="form-label text-dark">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Escribe tu nombre"
                        class="form-control @error('nombre') is-invalid @enderror"
                        value="{{ old('nombre', $modelos->nombre) }}">
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="marca" class="form-label text-dark">Marcas</label>
                    <select style="width: 100%" id="marca" name="marca" class="form-select buscador @error('marca') is-invalid @enderror">
                        <option selected disabled>Elegir marca</option>
                        @foreach ($marcas as $marca)
                            <option value="{{ $marca->id }}"
                                {{ old('marca', $modelos->marcas_id) == $marca->id ? 'selected' : '' }}>
                                {{ $marca->nombre }}</option>
                        @endforeach
                    </select>
                    @error('marca')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
          
            <div class="col-md-4">
                <div class="form-group">
                    <label for="estado" class="form-label text-dark">Estado</label>
                    <select id="estado" name="estado" class="form-select @error('estado') is-invalid @enderror">
                        <option selected disabled>Elegir estado</option>
                        <option value="1" {{ old('estado', $modelos->estado) == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('estado', $modelos->estado) == '0' ? 'selected' : '' }}>Inactivo
                        </option>
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
      

            <div class="col-md-12">
                <div class="form-group">
                    <label for="descripcion" class="form-label text-dark">Descripción</label>
                    <textarea id="descripcion" name="descripcion" rows="3"
                        class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion', $modelos->descripcion) }}</textarea>
                    @error('descripcion')
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
