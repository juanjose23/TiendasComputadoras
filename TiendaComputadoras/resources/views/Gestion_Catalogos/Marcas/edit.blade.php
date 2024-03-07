@extends('layout.layout')
@section('title', 'Marcas')
@section('submodulo', 'Actualizar Marcas')
@section('content')
    <form action="{{ route('marcas.update', $marcas) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nombre" class="form-label text-dark">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Escribe tu nombre"
                        class="form-control @error('nombre') is-invalid @enderror"
                        value="{{ old('nombre', $marcas->nombre) }}">
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="pais" class="form-label text-dark">Pais</label>
                    <select id="pais" name="pais" class="form-select buscador @error('pais') is-invalid @enderror">
                        <option selected disabled>Elegir pais</option>
                        @foreach ($paises as $pais)
                            <option value="{{ $pais->id }}"
                                {{ old('pais', $marcas->paises_id) == $pais->id ? 'selected' : '' }}>
                                {{ $pais->nombre }}</option>
                        @endforeach
                    </select>
                    @error('pais')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="sitio" class="form-label text-dark">Sitio web</label>
                    <input type="text" id="sitio" name="sitio" placeholder="Escribe el sitio web de la marca"
                        class="form-control @error('sitio') is-invalid @enderror"
                        value="{{ old('sitio', $marcas->sitio_web) }}">
                    @error('sitio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="estado" class="form-label text-dark">Estado</label>
                    <select id="estado" name="estado" class="form-select @error('estado') is-invalid @enderror">
                        <option selected disabled>Elegir estado</option>
                        <option value="1" {{ old('estado', $marcas->estado) == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('estado', $marcas->estado) == '0' ? 'selected' : '' }}>Inactivo
                        </option>
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="logo" class="form-label text-dark">Logo:</label>
                    <div class="d-flex align-items-center">
                        <!-- Envuelve la imagen y el campo de carga de archivos en un contenedor flexible -->
                        @if ($imagen->isNotEmpty())
                            @foreach ($imagen as $imagen)
                                <img src="{{ $imagen->url }}" width="36" height="36" class="rounded-circle me-2"
                                    alt="Logo"> <!-- Muestra la imagen si está presente -->
                            @endforeach
                        @endif
                        <input type="file" id="logo" name="logo" placeholder="Ingresa un logo"
                            class="form-control @error('logo') is-invalid @enderror" value="{{ old('logo') }}">
                    </div>
                    @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="descripcion" class="form-label text-dark">Descripción</label>
                    <textarea id="descripcion" name="descripcion" rows="3"
                        class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion', $marcas->descripcion) }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                    <a href="{{ route('marcas.index') }}" class="btn btn-danger mb-2 me-md-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary mb-2">Registrar</button>
                </div>

            </div>
        </div>
    </form>

@endsection
