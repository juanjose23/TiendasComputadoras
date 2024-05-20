@extends('layout.layout')
@section('title', 'Proveedores')
@section('submodulo', 'Actualizar Proveedor')
@section('content')
    <form action="{{ route('proveedores.update',$proveedores->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nombre" class="form-label text-dark">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Escribe tu nombre"
                        class="form-control @error('nombre') is-invalid @enderror"
                        value="{{ old('nombre', $proveedores->personas->nombre) }}">
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="apellido" class="form-label text-dark"> Razon social o Apellido:</label>
                    <input type="text" id="apellido" name="apellido" placeholder="Escribe el Apellido"
                        class="form-control @error('apellido') is-invalid @enderror"
                        value="{{ old('apellido', isset($proveedores->personas->persona_naturales->apellido) ? $proveedores->personas->persona_naturales->apellido : $proveedores->personas->persona_juridicas->razon_social) }}">
                    @error('apellido')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="fecha" class="form-label text-dark">Fecha Constitucional:</label>
                    <input type="date" id="fecha" name="fecha" placeholder="Escribe la fecha de constitucional"
                        class="form-control @error('fecha') is-invalid @enderror"
                        value="{{ old('fecha', isset($proveedores->personas->persona_naturales->fecha_nacimiento) ? $proveedores->personas->persona_naturales->fecha_nacimiento : $proveedores->personas->persona_juridicas->fecha_constitucional) }}">
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
                            {{ old('tipo', isset($proveedores->personas->persona_naturales->tipo_identificacion) ? $proveedores->personas->persona_naturales->tipo_identificacion : 'RUC') == 'Cedula' ? 'selected' : '' }}>
                            Cédula</option>
                        <option value="Cédula de Residencia Temporal"
                            {{ old('tipo', isset($proveedores->personas->persona_naturales->tipo_identificacion) ? $proveedores->personas->persona_naturales->tipo_identificacion : 'RUC') == 'Cedula de Residencia Temporal' ? 'selected' : '' }}>
                            Cédula de Residencia
                            Temporal</option>
                        <option value="Cédula de Residencia"
                            {{ old('tipo', isset($proveedores->personas->persona_naturales->tipo_identificacion) ? $proveedores->personas->persona_naturales->tipo_identificacion : 'RUC') == 'Cedula de Residencia' ? 'selected' : '' }}>
                            Cédula de
                            Residencia</option>
                        <option value="RUC"
                            {{ old('tipo', isset($proveedores->personas->persona_naturales->tipo_identificacion) ? $proveedores->personas->persona_naturales->tipo_identificacion : 'RUC') == 'RUC' ? 'selected' : '' }}>
                            RUC</option>
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
                        value="{{ old('identificacion', isset($proveedores->personas->persona_naturales->identificacion) ? $proveedores->personas->persona_naturales->identificacion : $proveedores->personas->persona_juridicas->ruc) }}">
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
                        value="{{ old('correo', $proveedores->personas->correo) }}">
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
                        value="{{ old('telefono', $proveedores->personas->telefono) }}">
                    @error('telefono')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="celular" class="form-label text-dark">Celular:</label>
                    <input type="number" id="celular" name="celular" placeholder="Escribe el número telefonico"
                        class="form-control @error('celular') is-invalid @enderror"
                        value="{{ old('celular', $proveedores->telefono) }}">
                    @error('celular')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="sector" class="form-label text-dark">Linea de abastecimiento:</label>
                    <select style="width: 100%" id="sector" name="sector"
                        class="form-control buscador @error('sector') is-invalid @enderror">
                        <option disabled>Elegir Linea de abastecimiento</option>
                        <option value="Niños" {{ old('sector') == 'Niños' ? 'selected' : '' }}>Ropa de niño</option>
                        <option value="Hombres" {{ old('sector') == 'Hombres' ? 'selected' : '' }}>Ropas de Hombres
                        </option>
                        <option value="Mujeres" {{ old('sector') == 'Mujeres' ? 'selected' : '' }}>Ropas de Mujeres
                        </option>
                        <option value="Deportes" {{ old('sector') == 'Deportes' ? 'selected' : '' }}>Ropas de Deportes
                        </option>
                        <option value="Bebes" {{ old('sector') == 'Bebes' ? 'selected' : '' }}>Ropas de bebes</option>
                        <option value="Accessorios" {{ old('sector') == 'Accessorios' ? 'selected' : '' }}>Ropas de
                            Accesorios</option>
                        <option value="Otros    " {{ old('sector') == 'Otros' ? 'selected' : '' }}>Otros</option>
                    </select>
                    @error('sector')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Países -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="pais" class="form-label text-dark">País</label>
                    <select style="width: 100%" id="pais" name="pais"
                        class="form-control buscador @error('pais') is-invalid @enderror">
                        <option>Elegir país</option>
                        @foreach ($datos['paises'] as $pais)
                            <option value="{{ $pais->id }}"
                                {{ old('pais', $proveedores->paises_id) == $pais->id ? 'selected' : '' }}>
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
                    <label for="departamentos" class="form-label text-dark">Localización:</label>
                    <select style="width: 100%" id="departamentos" name="departamentos"
                        class="buscador form-control @error('departamentos') is-invalid @enderror">
                        <option disabled>Selecciona un departamento</option>
                        @foreach ($datos['departamentos'] as $departamento => $municipios)
                            <optgroup label="{{ $departamento }}">
                                @foreach ($municipios as $municipio)
                                    <option value="{{ $municipio['id'] }}"
                                        {{ old('departamentos', $proveedores->personas->direcciones[0]->municipios_id) == $municipio['id'] ? 'selected' : '' }}>
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
            <div class="col-md-4">
                <div class="form-group">
                    <label for="estado" class="form-label text-dark">Estado:</label>
                    <select style="width: 100%" id="estado" name="estado"
                        class="form-control buscador @error('estado') is-invalid @enderror">
                        <option>Elegir estado</option>
                        <option value="1" {{ old('estado', $proveedores->estado) == '1' ? 'selected' : '' }}>Activo
                        </option>
                        <option value="0" {{ old('estado', $proveedores->estado) == '0' ? 'selected' : '' }}>Inactivo
                        </option>
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-2 d-flex justify-content-center align-items-center my-3">
                <div class="form-group">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="rounded-circle overflow-hidden" style="width: 50px; height: 50px;">
                            @if (empty($imagenes))
                                @foreach ($imagenes as $imagen)
                                    <img src="{{ $imagen->url }}" alt="Vista previa de la imagen" class="w-100 h-100">
                                @endforeach
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ $proveedores->personas->nombre }}" alt="Vista previa de la imagen" class="w-100 h-100">
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
                    <textarea id="punto" name="punto" rows="3" class="form-control @error('punto') is-invalid @enderror">{{ old('punto', $proveedores->personas->direcciones[0]->punto_referencia) }}</textarea>
                    @error('punto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="direccion" class="form-label text-dark">Dirección:</label>
                    <textarea id="direccion" name="direccion" rows="3"
                        class="form-control @error('direccion') is-invalid @enderror">{{ old('direccion', $proveedores->personas->direcciones[0]->direccion) }}</textarea>
                    @error('direccion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="descripcion" class="form-label text-dark">Descripcion:</label>
                    <textarea id="descripcion" name="descripcion" rows="3"
                        class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion', $proveedores->descripcion) }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-check self-center mb-3">
                    <input class="form-check-input" type="checkbox" value="{{ old('juridica') }}" id="remember-me"
                        name="juridico" {{ isset($proveedores->personas->persona_juridicas->ruc) ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember-me">
                        ¿Es persona Juridica?
                    </label>
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
