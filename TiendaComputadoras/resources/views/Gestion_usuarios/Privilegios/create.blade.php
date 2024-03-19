@extends('layout.layout')
@section('title', 'Privilegios')
@section('submodulo', 'Registrar privilegios de roles')
@section('content')
    <form id="crear" name="crear" method="POST" action="index.php?c=usuario&a=GuardarPrivilegio" autocomplete="off">

        <div class="form-group row">
            <div class="col-md-4">

                <label for="rol" class="form-label">Rol:</label>
                <select id="rol" name="rol" class="form-select buscador @error('rol') is-invalid @enderror"
                    style="width: 100%">
                    @foreach ($Roles as $rol)
                        <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                    @endforeach
                </select>

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
                                        <input type="checkbox" name="submodulos[{{ $submodulo['id'] }}][]"
                                            value="{{ $submodulo['id'] }}" class="flat ">
                                        <span>{{ $submodulo['nombre'] }}</span>
                                    </div>
                                @endforeach
                                <button type="button" class="btn btn-success seleccionar-todo"
                                    data-modulo="{{ $modulo['nombre'] }}">Seleccionar Todo</button>
                            </div>
                        @endforeach



                    </div>
                </div>

            </div>
        </div>

    </form>

@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var seleccionarTodoBotones = document.querySelectorAll('.seleccionar-todo');

        seleccionarTodoBotones.forEach(function(boton) {
            boton.addEventListener('click', function() {
                var modulo = this.getAttribute('data-modulo');
                var checkboxes = document.querySelectorAll(
                    'input[type="checkbox"][name^="submodulos[' + modulo + ']"]');

                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = true;
                });
            });
        });
    });
</script>
