@extends('layout.layout')
@section('title', 'Empresa')
@section('submodulo', 'Actualizar datos de la empresa')
@section('content')
    <form action="{{ route('empresa.update',$personas->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nombre" class="form-label text-dark">Nombre de la empresa</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Escribe tu nombre"
                        class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre',$personas->nombre) }}">
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="apellido" class="form-label text-dark"> Razon social:</label>
                    <input type="text" id="apellido" name="apellido" placeholder="Escribe la razon social"
                        class="form-control @error('apellido') is-invalid @enderror" value="{{ old('apellido',$personas->persona_juridicas->razon_social) }}">
                    @error('apellido')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="fecha" class="form-label text-dark">Fecha Constitucional o de fundanción:</label>
                    <input type="date" id="fecha" name="fecha" placeholder="Escribe la fecha de constitucional"
                        class="form-control @error('fecha') is-invalid @enderror" value="{{ old('fecha',$personas->persona_juridicas->fecha_constitucional) }}">
                    @error('fecha')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="identificacion" class="form-label text-dark">Número de identificación:</label>
                    <input type="identificacion" id="identificacion" name="identificacion"
                        placeholder="Escribe el número de identificación"
                        class="form-control @error('identificacion') is-invalid @enderror"
                        value="{{ old('identificacion',$personas->persona_juridicas->ruc) }}">
                    @error('identificacion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="correo" class="form-label text-dark">Correo:</label>
                    <input type="email" id="correo" name="correo" placeholder="Escribe tu correo"
                        class="form-control @error('correo') is-invalid @enderror" value="{{ old('correo',$personas->correo) }}">
                    @error('correo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="telefono" class="form-label text-dark">Télefono:</label>
                    <input type="number" id="telefono" name="telefono" placeholder="Escribe el número telefonico"
                        class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono',$personas->telefono) }}">
                    @error('telefono')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
           
          


            <div class="col-md-4">
                <div class="form-group">
                    <label for="departamentos" class="form-label text-dark">Localización:</label>
                    <select style="width: 100%" id="departamentos" name="departamentos"
                        class="buscador form-control @error('departamentos') is-invalid @enderror">
                        <option disabled>Selecciona un departamento</option>
                        @foreach ($datos['departamentos'] as $departamento => $municipios)
                            <optgroup label="{{ $departamento }}">
                                @foreach ($municipios as $municipio)
                                    <option value="{{ $municipio['id'] }}"
                                        {{ old('departamentos', $personas->direcciones[0]->municipios_id) == $municipio['id'] ? 'selected' : '' }}>
                                        {{ $municipio['nombre'] }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    @error('departamentos')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="col-md-2 d-flex justify-content-center align-items-center my-3">
                <div class="form-group">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="rounded-circle overflow-hidden" style="width: 50px; height: 50px;">
                            @if (!empty($imagenes))
                                @foreach ($imagenes as $imagen)
                                    <img src="{{ $imagen->url }}" alt="Vista previa de la imagen" class="w-100 h-100">
                                @endforeach
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ $personas->nombre }}" alt="Vista previa de la imagen" class="w-100 h-100">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-10">
                <div class="form-group">
                    <label for="foto" class="form-label text-dark">Foto:</label>
                    <input type="file" id="foto" name="foto"
                        class="form-control @error('foto') is-invalid @enderror">
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="punto" class="form-label text-dark">Punto Referencia:</label>
                    <textarea id="punto" name="punto" rows="3" class="form-control @error('punto') is-invalid @enderror">{{ old('punto', $personas->direcciones[0]->punto_referencia) }}</textarea>
                    @error('punto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="direccion" class="form-label text-dark">Dirección:</label>
                    <textarea id="direccion" name="direccion" rows="3"
                        class="form-control @error('direccion') is-invalid @enderror">{{ old('direccion',$personas->direcciones[0]->direccion) }}</textarea>
                    @error('direccion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        
           

            <div class="col-md-12">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                    <a href="{{ route('proveedores.index') }}" class="btn btn-danger mb-2 me-md-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary mb-2">Registrar</button>
                </div>

            </div>
        </div>
    </form>

@endsection
