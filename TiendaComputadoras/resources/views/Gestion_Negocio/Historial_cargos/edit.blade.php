@extends('layout.layout')
@section('title', 'Asignaciones')
@section('submodulo', 'Actualizar asignación')
@section('content')
    <form action="{{ route('asignaciones.update',$empleados->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="empleado" class="form-label text-dark">Empleados:</label>
                    <input type="text" class="form-control" value="Código del empleado: {{$empleados->codigo}} {{$empleados->personas->nombre}} {{$empleados->personas->persona_naturales->apellido}}" disabled>
                    <input type="text" name="empleados" value="{{$empleados->id}}" hidden>
                </div>
            </div>


            <div class="col-md-4">
                <div class="form-group">
                    <label for="cargos" class="form-label text-dark">Cargos:</label>
                    <select style="width: 100%" id="cargos" name="cargos"
                        class="buscador form-select @error('cargos') is-invalid @enderror">
                        <option>Seleccionar Cargos</option>
                        @foreach ($cargos as $cargos)
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
                    <select id="estado" name="estado"
                        class="form-select buscador  @error('estado') is-invalid @enderror">
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
                    <a href="{{ route('asignaciones.index') }}" class="btn btn-danger mb-2 me-md-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary mb-2">Registrar</button>
                </div>

            </div>
        </div>
    </form>

    <div class="container-fluid p-0">
        <h3 class="h3 mb-3"></h3>
        <div class="row">
            <div class="col-12">
                <div class="">
                    <div class="card-header">
                        <h5 class="card-title mb-0 text-black">Lista de cargos</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col" class="px-4 py-3">
                                            <span class="sr-only">#</span>
                                        </th>
                                        <th scope="col" class="px-4 py-3">Código</th>
                                        <th scope="col" class="px-4 py-3">Cargos</th>
                                        <th scope="col" class="px-4 py-3">Fecha de registro</th>
                                        <th scope="col" class="px-4 py-3">Estado</th>
                                        <th scope="col" class="px-4 py-3">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($asignacion as $colaborador)
                                    <tr>
                                        <td>{{$loop->index}}</td>
                                        <td>{{$colaborador->cargos->codigo}}</td>
                                        <td>{{$colaborador->cargos->nombre}}</td>
                                        <td>{{$colaborador->created_at}}</td>
                                        <td><span
                                            class="badge rounded-pill {{ $colaborador->estado == 1 ? 'bg-success' : 'bg-danger' }}">
                                            {{ $colaborador->estado == 1 ? 'Activo' : 'Inactivo' }}
                                        </span></td>
                                        <td>
                                            <div class="mr-1">
                                                <!-- Botón para activar/desactivar -->
                                                <button type="button"
                                                    class="btn btn-{{ $colaborador->estado == 1 ? 'danger' : 'success' }}"
                                                    role="button" onclick="confirmAction({{ $colaborador->id }})">
                                                    <i
                                                        class="bi bi-{{ $colaborador->estado == 1 ? 'trash' : 'power' }}"></i>
                                                </button>
                                            </div>
                                            <form id="deleteForm{{ $colaborador->id }}"
                                                action="{{ route('asignaciones.destroy', ['asignaciones' => $colaborador->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                    
                                                <!-- Este botón no es visible, pero se utilizará para activar el SweetAlert -->
                                                <button id="submitBtn{{ $colaborador->id }}" type="submit"
                                                    style="display: none;"></button>
                                            </form>
                    
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function confirmAction(colaboradorId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Quieres cambiar el estado de esta asignación?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, cambiar estado'
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById('deleteForm' + colaboradorId);

                // Agregar un campo oculto al formulario para indicar la acción
                var actionInput = document.createElement('input');
                actionInput.type = 'hidden';
                actionInput.name = '_method';
                actionInput.value = 'DELETE';
                form.appendChild(actionInput);

                // Enviar el formulario
                form.submit();
            }
        });
    }
</script>
