@extends('layout.layout')
@section('title', 'Empleados')
@section('submodulo', 'Actualizar Colaborador')
@section('content')
    <form action="{{ route('colaboradores.update', $empleados->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nombre" class="form-label text-dark">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Escribe tu nombre"
                        class="form-control @error('nombre') is-invalid @enderror"
                        value="{{ old('nombre', $empleados->personas->nombre) }}">
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="apellido" class="form-label text-dark">Apellido:</label>
                    <input type="text" id="apellido" name="apellido" placeholder="Escribe el Apellido"
                        class="form-control @error('apellido') is-invalid @enderror"
                        value="{{ old('apellido', $empleados->personas->persona_naturales->apellido) }}">
                    @error('apellido')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="fecha" class="form-label text-dark">Fecha Nacimiento:</label>
                    <input type="date" id="fecha" name="fecha" placeholder="Escribe la fecha de nacimiento"
                        class="form-control @error('fecha') is-invalid @enderror"
                        value="{{ old('fecha', $empleados->personas->persona_naturales->fecha_nacimiento) }}">
                    @error('fecha')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="tipo" class="form-label text-dark">Tipo de identificación:</label>
                    <select id="tipo" name="tipo" class="form-select @error('tipo') is-invalid @enderror">
                        <option selected disabled>Elegir identificación</option>
                        <option value="Cedula"
                            {{ old('tipo', $empleados->personas->persona_naturales->tipo_identificacion) == 'Cedula' ? 'selected' : '' }}>
                            Cédula</option>
                        <option value="Cédula de Residencia Temporal"
                            {{ old('tipo', $empleados->personas->persona_naturales->tipo_identificacion) == 'Cédula de Residencia Temporal' ? 'selected' : '' }}>
                            Cédula de Residencia
                            Temporal</option>
                        <option value="Cédula de Residencia"
                            {{ old('tipo', $empleados->personas->persona_naturales->tipo_identificacion) == 'Pasaporte' ? 'selected' : '' }}>
                            Cédula de
                            Residencia</option>
                    </select>
                    @error('tipo')
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
                        value="{{ old('identificacion', $empleados->personas->persona_naturales->identificacion) }}">
                    @error('identificacion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="correo" class="form-label text-dark">Correo:</label>
                    <input type="email" id="correo" name="correo" placeholder="Escribe tu correo"
                        class="form-control @error('correo') is-invalid @enderror"
                        value="{{ old('correo', $empleados->personas->correo) }}">
                    @error('correo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="telefono" class="form-label text-dark">Télefono:</label>
                    <input type="number" id="telefono" name="telefono" placeholder="Escribe el número telefonico"
                        class="form-control @error('telefono') is-invalid @enderror"
                        value="{{ old('telefono', $empleados->personas->telefono) }}">
                    @error('telefono')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="inss" class="form-label text-dark">Número Inss:</label>
                    <input type="text" id="inss" name="inss" placeholder="Escribe el número inss"
                        class="form-control @error('inss') is-invalid @enderror"
                        value="{{ old('inss', $empleados->codigo_inss) }}">
                    @error('inss')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Países -->
            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <label for="pais" class="form-label text-dark">País</label>
                    <select style="width: 100%" id="pais" name="pais"
                        class="form-control buscador @error('pais') is-invalid @enderror">
                        <option disabled>Elegir país</option>
                        @foreach ($datos['paises'] as $pais)
                            <option value="{{ $pais->id }}"
                                {{ old('pais', $empleados->personas->persona_naturales->paises_id) == $pais->id ? 'selected' : '' }}>
                                {{ $pais->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('pais')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="genero" class="form-label text-dark">Género</label>
                    <select style="width: 100%"id="genero" name="genero"
                        class="form-select buscador @error('genero') is-invalid @enderror">
                        <option disabled>Elegir género</option>
                        @foreach ($datos['generos'] as $genero)
                            <option value="{{ $genero->id }}"
                                {{ old('genero', $empleados->personas->persona_naturales->generos_id) == $genero->id ? 'selected' : '' }}>
                                {{ $genero->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('genero')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="col-lg-4 col-md-4">
                <div class="form-group">
                    <label for="estado_civil" class="form-label text-dark">Estado Civil</label>
                    <select style="width: 100%" id="estado_civil" name="estado_civil"
                        class=" form-select @error('estado_civil') is-invalid @enderror">
                        <option disabled>Elegir estado civil</option>
                        @foreach ($datos['estadosCiviles'] as $estadoCivil)
                            <option value="{{ $estadoCivil->id }}"
                                {{ old('estado_civil', $empleados->estado_civiles_id) == $estadoCivil->id ? 'selected' : '' }}>
                                {{ $estadoCivil->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('estado_civil')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="col-md-4">
                <div class="form-group">
                    <label for="estado" class="form-label text-dark">Estado:</label>
                    <select id="estado" name="estado" class="form-select @error('estado') is-invalid @enderror">
                        <option>Elegir estado</option>
                        <option value="1" {{ old('estado', $empleados->estado) == '1' ? 'selected' : '' }}>Activo
                        </option>
                        <option value="0" {{ old('estado', $empleados->estado) == '0' ? 'selected' : '' }}>
                            Inactivo
                        </option>
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <div class=" d-flex align-items-center">
                        <div class="rounded-circle overflow-hidden mx-3 my-auto" style="width: 50px; height: 50px;">
                            @foreach ($imagenes as $imagen)
                                <img src="{{ $imagen->url }}" alt="Vista previa de la imagen"
                                    class="w-100 h-100">
                            @endforeach
                        </div>
                    </div>

                </div>
                <!-- Imagen redonda para mostrar la vista previa -->
            </div>

            <div class="col-md-6">
                <div class="form-group">


                    <label for="foto" class="form-label text-dark">Foto:</label>
                    <!-- Input para seleccionar el archivo -->
                    <input type="file" id="foto" name="foto"
                        class="form-control @error('foto') is-invalid @enderror">

                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Imagen redonda para mostrar la vista previa -->



            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="departamentos" class="form-label text-dark">Localización:</label>
                    <select style="width: 100%"id="departamentos" name="departamentos"
                        class="buscador form-select @error('departamentos') is-invalid @enderror">
                        <option disabled>Selecciona un departamento</option>
                        @foreach ($datos['departamentos'] as $departamento => $municipios)
                            <optgroup label="{{ $departamento }}">
                                @foreach ($municipios as $municipio)
                                    <option value="{{ $municipio['id'] }}"
                                        {{ old('departamentos', $empleados->personas->direcciones[0]->municipios_id) == $municipio['id'] ? 'selected' : '' }}>
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

            <div class="col-md-6">
                <div class="form-group">
                    <label for="punto" class="form-label text-dark">Punto Referencia:</label>
                    <textarea id="punto" name="punto" rows="3" class="form-control @error('punto') is-invalid @enderror">{{ old('punto', $empleados->personas->direcciones[0]->punto_referencia) }}</textarea>
                    @error('punto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="direccion" class="form-label text-dark">Dirección:</label>
                    <textarea id="direccion" name="direccion" rows="3"
                        class="form-control @error('direccion') is-invalid @enderror">{{ old('direccion', $empleados->personas->direcciones[0]->direccion) }}</textarea>
                    @error('direccion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                    <a href="{{ route('colaboradores.index') }}" class="btn btn-danger mb-2 me-md-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary mb-2">Registrar</button>
                </div>

            </div>
        </div>
    </form>

@endsection
