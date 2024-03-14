@extends('layout.layout')
@section('title', 'Asignaciones')
@section('submodulo', 'Registrar asignación')
@section('content')
    <form action="{{ route('asignaciones.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="empleado" class="form-label text-dark">Empleados:</label>
                    <select style="width: 100%" id="empleado" name="empleados" class="buscador form-select @error('empleados') is-invalid @enderror">
                        <option>Seleccionar Empleado</option>
                        @foreach ($datos['empleados'] as $empleado)

                            <option value="{{ $empleado->id }}" {{ old('empleados') == $empleado->id ? 'selected' : '' }}>
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
                    <label for="cargos" class="form-label text-dark">Cargos:</label>
                    <select style="width: 100%" id="cargos" name="cargos" class="buscador form-select @error('cargos') is-invalid @enderror">
                        <option>Seleccionar Cargos</option>
                        @foreach ($datos['cargos'] as $cargos)

                            <option value="{{ $cargos->id }}" {{ old('cargos') == $cargos->id ? 'selected' : '' }}>
                                Código: {{ $cargos->codigo }} {{ $cargos->nombre }}
                                </option>
                        @endforeach
                    </select>
                    @error('cargos')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="estado" class="form-label text-dark">Estado</label>
                    <select id="estado" name="estado" class="form-select buscador  @error('estado') is-invalid @enderror">
                        <option selected disabled>Elegir estado</option>
                        <option value="1" {{ old('estado') == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                    <a href="{{ route('cargos.index') }}" class="btn btn-danger mb-2 me-md-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary mb-2">Registrar</button>
                </div>

            </div>
        </div>
    </form>

@endsection
