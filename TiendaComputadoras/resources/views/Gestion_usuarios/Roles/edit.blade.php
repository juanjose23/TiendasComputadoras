@extends('layout.layout')
@section('title', 'Roles')
@section('submodulo', 'Actualizar Roles')
@section('content')
    <form action="{{ route('roles.update',$rol->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nombre" class="form-label text-dark">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Escribe el nombre del rol"
                        class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre',$rol->nombre) }}">
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="estado" class="form-label text-dark">Estado</label>
                    <select id="estado" name="estado" class="form-select @error('estado') is-invalid @enderror">
                        <option selected disabled>Elegir estado</option>
                        <option value="1" {{ old('estado',$rol->estado) == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('estado',$rol->estado) == '0' ? 'selected' : '' }}>Inactivo</option>
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
                        class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion',$rol->descripcion) }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        
            <div class="col-md-12">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                    <a href="{{ route('roles.index') }}" class="btn btn-danger mb-2 me-md-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary mb-2">Actualizar</button>
                </div>
                
            </div>
        </div>
    </form>

@endsection
