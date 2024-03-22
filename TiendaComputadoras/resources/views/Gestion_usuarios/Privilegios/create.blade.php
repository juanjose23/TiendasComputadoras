@extends('layout.layout')
@section('title', 'Privilegios')
@section('submodulo', 'Registrar privilegios de roles')
@section('content')
    <form id="crear" name="crear" method="POST" action="{{ route('privilegios.store') }}" autocomplete="off">
        @csrf
        <div class="form-group row @error('rol') is-invalid @enderror">
            <div class="col-md-4">

                <label for="rol" class="form-label">Rol:</label>
                <select id="rol" name="rol" class="form-select buscador @error('rol') is-invalid @enderror"
                    style="width: 100%">
                    <option value="" selected>Seleccionar rol</option>

                    @foreach ($Roles as $rol)
                        <option value="{{ $rol->id }}" {{ old('rol') == $rol->id ? 'selected' : '' }}>
                            {{ $rol->nombre }}</option>
                    @endforeach
                </select>
                @error('rol')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror


            </div>

            <div class="col-md-4 col-sm-12 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Asignar privilegios</button>
            </div>
        </div>
        <div class="mt-4"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="form-group">

                    <div class="row">
                        @foreach ($modulos as $modulo)
                            <div class="col-md-4">
                                <h5>{{ $modulo['nombre'] }}</h5>
                                @foreach ($modulo['submodulos'] as $submodulo)
                                    <div style="margin-left: 20px; margin-bottom: 10px;">
                                        <input type="checkbox" name="submodulos[{{ $modulo['id'] }}][]"
                                            value="{{ $submodulo['id'] }}" class="flat   @error("submodulos.$modulo[id]") is-invalid @enderror"
                                            @if (old("submodulos.$modulo[id]") && in_array($submodulo['id'], old("submodulos.$modulo[id]"))) checked @endif>
                                        <span>{{ $submodulo['nombre'] }}</span>
                                    </div>
                                @endforeach
                                @error("submodulos.$modulo[id]")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <button type="button" class="btn btn-success seleccionar-todo"
                                    data-modulo="{{ $modulo['id'] }}">Seleccionar Todo</button>
                            </div>
                        @endforeach


                    </div>
                </div>

            </div>
        </div>

    </form>
    <script>
        var todosSeleccionados = false;

        function toggleSeleccionModulo(moduloId) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"][name="submodulos[' + moduloId + '][]"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = !todosSeleccionados;
            });
            todosSeleccionados = !todosSeleccionados;
            actualizarBoton(moduloId);
        }

        function actualizarBoton(moduloId) {
            var boton = document.querySelector('button[data-modulo="' + moduloId + '"]');
            var todosSeleccionadosEnModulo = todosLosCheckboxesSeleccionadosEnModulo(moduloId);

            if (todosSeleccionadosEnModulo) {
                boton.textContent = 'Deseleccionar Todo';
                boton.classList.remove('btn-success');
                boton.classList.add('btn-danger');
            } else {
                boton.textContent = 'Seleccionar Todo';
                boton.classList.remove('btn-danger');
                boton.classList.add('btn-success');
            }
        }

        function todosLosCheckboxesSeleccionadosEnModulo(moduloId) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"][name="submodulos[' + moduloId + '][]"]');
            return Array.from(checkboxes).every(function(checkbox) {
                return checkbox.checked;
            });
        }

        // Event listeners for button clicks
        document.querySelectorAll('.seleccionar-todo').forEach(function(boton) {
            boton.addEventListener('click', function() {
                var moduloId = this.getAttribute('data-modulo');
                toggleSeleccionModulo(moduloId);
            });
        });
    </script>

@endsection
