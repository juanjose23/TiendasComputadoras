@extends('layout.layout')
@section('title', 'usuarios')
@section('submodulo', 'Registrar usuario')
@section('content')
    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="empleado" class="form-label text-dark">Empleados:</label>
                    <select style="width: 100%" id="empleado" name="empleados"
                        class="buscador form-select @error('empleados') is-invalid @enderror">
                        <option>Seleccionar Empleado</option>
                        @foreach ($empleados as $empleado)
                            <option value="{{ $empleado->personas->id }}"
                                {{ old('empleados') == $empleado->id ? 'selected' : '' }}>
                                Código empleado: {{ $empleado->codigo }} {{ $empleado->personas->nombre }}
                                {{ $empleado->personas->persona_naturales->apellido }}</option>
                        @endforeach
                    </select>
                    @error('empleados')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="col-md-4">
                <div class="form-group">
                    <label for="roles" class="form-label text-dark">Roles:</label>
                    <select style="width: 100%" id="roles" name="roles"
                        class="buscador form-select @error('roles') is-invalid @enderror">
                        <option>Seleccionar roles</option>
                        @foreach ($roles as $rol)
                            <option value="{{ $rol->id }}" {{ old('roles') == $rol->id ? 'selected' : '' }}>
                                {{ $rol->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('roles')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="estado" class="form-label text-dark">Estado</label>
                    <select id="estado" name="estado"
                        class="form-select buscador  @error('estado') is-invalid @enderror">
                        <option selected disabled>Elegir estado</option>
                        <option value="2" {{ old('estado') == '1' ? 'selected' : '' }}>Verificar</option>
                        <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                    <a href="{{ route('usuarios.index') }}" class="btn btn-danger mb-2 me-md-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary mb-2">Registrar</button>
                </div>

            </div>
        </div>
    </form>

@endsection
@if(session('pdf_sent'))
    <script>
        // Adjunta un evento a la descarga del PDF
        window.onload = function() {
            var pdfUrl = "{{ route('usuarios.index') }}"; // URL de la ruta usuarios.index

            // Espera a que la descarga del PDF esté completa
            window.onload = function() {
                // Redirige al usuario a la ruta usuarios.index después de la descarga del PDF
                window.location.href = pdfUrl;
            };
        };
    </script>
@endif



