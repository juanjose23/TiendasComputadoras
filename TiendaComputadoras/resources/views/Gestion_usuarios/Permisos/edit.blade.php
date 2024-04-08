@extends('layout.layout')
@section('title', 'Privilegios')
@section('submodulo', 'Asignar nuevos privilegios')
@section('content')
    <form id="crear" name="crear" method="POST" action="{{ route('permisos.store') }}" autocomplete="off">
        @csrf
        <div class="row">

            <div class="col-md-12">
                <div class="form-group">

                    <label for="rol" class="form-label">Rol:</label>
                    <input type="text" class="form-control" value="{{ $rol->nombre }}" disabled>
                    <input type="text" name="rol" value="{{ $rol->id }}" hidden>
                </div>
            </div>

            <div class="mt-4"></div>

            <div class="col-md-12 col-sm-12">
                <div class="form-group">

                    <div class="row">
                        @foreach ($permisos as $modulo)
                            <div class="col-md-4">
                                <h5>{{ $modulo['nombre'] }}</h5>
                                @foreach ($modulo['permisos'] as $submodulo)
                                    <div style="margin-left: 20px; margin-bottom: 10px;">
                                        <input type="checkbox" name="submodulos[{{ $modulo['id'] }}][]"
                                            value="{{ $submodulo['id_permiso_modulo'] }}"
                                            class="flat   @error("submodulos.$modulo[id]") is-invalid @enderror"
                                            @if (old("submodulos.$modulo[id]") && in_array($submodulo['id_permiso_modulo'], old("submodulos.$modulo[id]"))) checked @endif>
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
            <div class="col-md-6">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                    <a href="{{ route('permisos.index') }}" class="btn btn-danger mb-2 me-md-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary mb-2">Actualizar</button>
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
