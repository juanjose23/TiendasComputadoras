<div wire:poll.1s>
    {{$buscar}}
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div class="input-group mb-3" style="max-width: 300px;">
                <input type="text" wire:model.live="buscar" class="form-control form-control rounded-start"
                placeholder="Buscar...">
        </div>

        <!-- Contenedor con alineación a la derecha -->
        <div class="d-flex justify-content-end flex-wrap mt-3 mt-md-0">
            <!-- Botón para crear un cargo -->
            <div class="dropdown">
                <div class="btn-group ms-2 mb-2 mb-md-0">
                    <a href="{{ route('salarios.create') }}" class="btn btn-success btn-icon">
                        <i class="bi bi-file-earmark-plus-fill"></i> Asignar salario
                    </a>
                </div>
            </div>

            <!-- Botón de exportación -->
            <div class="btn-group ms-2 mb-2 mb-md-0">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle btn-icon" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bi bi-box-arrow-up-right"></i> Exportaciones
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('exportcargosexcel') }}" class="dropdown-item"><i
                                    class="bi bi-file-earmark-spreadsheet text-success"></i>
                                Exportar a Excel
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Botón para seleccionar cantidad de registros a mostrar -->
            <div class="ms-2">
                <select name="buscador" id="buscador" wire:model.live="perPage" class="form-select mt-2 mt-md-0">
                    <option value="">Mostrar en:</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="0">Todos</option>
                </select>
            </div>
        </div>
    </div>


    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th scope="col" class="px-4 py-3">
                        <span class="sr-only">#</span>
                    </th>
                    <th scope="col" class="px-4 py-3">Codigo</th>
                    <th scope="col" class="px-4 py-3">Nombre</th>
                    <th scope="col" class="px-4 py-3">Apellido</th>
                    <th scope="col" class="px-4 py-3">Salario</th>
                    <th scope="col" class="px-4 py-3">Estado</th>
                    <th scope="col" class="px-4 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach ($Salarios as $Salarios)
                <tr>
                    <th>{{ $Salarios->id }}</th>
                    <td>{{ $Salarios->empleados->codigo }}</td>

                    <td>{{ $Salarios->empleados->personas->nombre }}</td>
                    <td>{{ $Salarios->empleados->personas->persona_naturales->apellido }}</td>
                    <td>{{ $Salarios->salario }}</td>
                    <td><span class="badge rounded-pill {{ $Salarios->estado == 1 ? 'bg-success' : 'bg-danger' }}">
                            {{ $Salarios->estado == 1 ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                    <td>

                        <div class="mb-2">
                            <a href="{{ route('salarios.edit', ['salarios' => $Salarios->empleados_id]) }}"
                                class="btn btn-info d-block" role="button">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </div>
                        <div class="mb-2">
                            <a href="{{ route('salarios.show', ['salarios' => $Salarios->empleados_id]) }}"
                                class="btn btn-info d-block" role="button">
                                <i class="bi bi-eye"></i>
                            </a>
                        </div>



                    </td>
                </tr>
                @endforeach
                </tr>
            </tbody>
        </table>
      
    </div>
</div>
<!-- JavaScript -->
<!-- JavaScript -->
<script>
    function confirmAction(cargoId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Quieres cambiar el estado de este cargo?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, cambiar estado'
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById('deleteForm' + cargoId);

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
