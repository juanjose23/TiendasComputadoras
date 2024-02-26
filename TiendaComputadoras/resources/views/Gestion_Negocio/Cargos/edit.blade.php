@extends('layout.layout')
@section('title', 'Cargos')
@section('submodulo', 'Actualizar Cargo')
@section('content')
    <form action="{{ route('cargos.update', $cargos) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <input type="hidden" id="codigo" name="codigo" value="{{ $cargos->codigo }}">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nombre" class="form-label text-dark">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Escribe tu nombre"
                        class="form-control @error('nombre') is-invalid @enderror" value="{{ $cargos->nombre }}">
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="estado" class="form-label text-dark">Estado</label>
                    <select id="estado" name="estado" class="form-select @error('estado') is-invalid @enderror">
                        <option selected disabled>Elegir estado</option>
                        <option value="1" {{ $cargos->estado == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ $cargos->estado == '0' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="perfil" class="form-label text-dark">Perfil</label>
                    <input type="text" id="perfil" name="perfil" placeholder="Escriba el perfil de cargo"
                        class="form-control @error('perfil') is-invalid @enderror" value="{{ $cargos->perfil }}">
                    @error('perfil')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="descripcion" class="form-label text-dark">Descripción</label>
                    <textarea id="descripcion" name="descripcion" rows="3"
                        class="form-control @error('descripcion') is-invalid @enderror">{{ $cargos->descripcion }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                    <a href="{{ route('cargos.index') }}" class="btn btn-danger mb-2 me-md-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary mb-2">Actualizar</button>
                </div>

            </div>
        </div>
    </form>

@endsection
