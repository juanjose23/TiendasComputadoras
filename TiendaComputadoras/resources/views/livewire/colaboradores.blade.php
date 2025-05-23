<div>
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div class="input-group mb-3" style="max-width: 300px;">
            <input type="text" wire:model.live.debounce.300ms="buscar" class="form-control form-control rounded-start"
                placeholder="Buscar...">
        </div>

        <!-- Contenedor con alineación a la derecha -->
        <div class="d-flex justify-content-end flex-wrap mt-3 mt-md-0">
            <!-- Botón para crear un cargo -->
            @can('create', App\Models\Empleados::class)
                <div class="dropdown">
                    <div class="btn-group ms-2 mb-2 mb-md-0">
                        <a href="{{ route('colaboradores.create') }}" class="btn btn-success btn-icon">
                            <i class="fas fa-plus"></i> Registrar colaborador
                        </a>
                    </div>
                </div>
            @endcan

            <!-- Botón de exportación -->
            <div class="btn-group ms-2 mb-2 mb-md-0">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle btn-icon" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bi bi-box-arrow-up-right"></i> Exportaciones
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('exportColaboradores') }}"><i
                                    class="fas fa-file-excel text-success"></i>
                                Exportar a Excel
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('exportColaboradorespdf') }}"><i
                                    class="fas fa-file-pdf text-danger"></i>
                                Exportar
                                a
                                PDF
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
                    <th scope="col" class="px-4 py-3">Código</th>
                    <th scope="col" class="px-4 py-3">Nombre</th>
                    <th scope="col" class="px-4 py-3">Apellido</th>
                    <th scope="col" class="px-4 py-3">Tipo de identificación</th>
                    <th scope="col" class="px-4 py-3">Identificación</th>
                    <th scope="col" class="px-4 py-3">Télefono</th>
                    <th scope="col" class="px-4 py-3">Correo</th>
                    <th scope="col" class="px-4 py-3">Estado</th>
                    <th scope="col" class="px-4 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($datos as $colaborador)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $colaborador->empleados->codigo }}</td>

                        <td>{{ $colaborador->nombre }}</td>
                        <td>{{ $colaborador->persona_naturales->apellido }}</td>
                        <td>{{ $colaborador->persona_naturales->tipo_identificacion }}</td>
                        <td>{{ $colaborador->persona_naturales->identificacion }}</td>
                        <td>{{ $colaborador->telefono }}</td>
                        <td>{{ $colaborador->correo }}</td>
                        <td><span
                                class="badge rounded-pill {{ $colaborador->empleados->estado == 1 ? 'bg-success' : 'bg-danger' }}">
                                {{ $colaborador->empleados->estado == 1 ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td>

                            <div class="d-flex mb-1 align-items-center">

                                @can('update', App\Models\Empleados::class)
                                    <a href="{{ route('colaboradores.edit', ['colaboradores' => $colaborador->empleados->id]) }}"
                                        class="btn btn-info" role="button">
                                        <i class="fas fa-edit"></i>

                                    </a>
                                @endcan
                                @can('delete', App\Models\Empleados::class)
                                    <div class="m-1">
                                        <!-- Botón para activar/desactivar -->
                                        <button type="button"
                                            class="btn btn-{{ $colaborador->empleados->estado == 1 ? 'danger' : 'success' }}"
                                            role="button" onclick="confirmAction({{ $colaborador->empleados->id }})">
                                            <i
                                                class="fas fa-{{ $colaborador->empleados->estado == 1 ? 'trash-alt' : 'toggle-on' }}"></i>
                                        </button>
                                    </div>
                                @endcan

                                <a href="{{ route('colaboradores.show', ['colaboradores' => $colaborador->empleados->id]) }}"
                                    class="btn btn-secondary" role="button">
                                    <i class="fas fa-info"></i>
                                </a>

                            </div>



                            <form id="deleteForm{{ $colaborador->empleados->id }}"
                                action="{{ route('colaboradores.destroy', ['colaboradores' => $colaborador->empleados->id]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')

                                <!-- Este botón no es visible, pero se utilizará para activar el SweetAlert -->
                                <button id="submitBtn{{ $colaborador->empleados->id }}" type="submit"
                                    style="display: none;"></button>
                            </form>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <div class="mt-4">
            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group me-2" role="group" aria-label="First group">
                    <!-- Botón para la página anterior -->
                    <button type="button" class="btn btn-primary" wire:click="previousPage"
                        {{ $datos->onFirstPage() ? 'disabled' : '' }}>
                        Previo
                    </button>
                </div>

                <!-- Botones para cada página -->
                @foreach ($datos->links() as $page => $url)
                    @if (
                        $loop->first ||
                            $loop->last ||
                            ($loop->index >= $datos->currentPage() - 2 && $loop->index <= $datos->currentPage() + 2))
                        <div class="btn-group me-2" role="group" aria-label="Page {{ $page }}">
                            <button type="button"
                                class="btn btn-primary {{ $datos->currentPage() == $page ? 'active' : '' }}"
                                wire:click="gotoPage({{ $page }})">
                                {{ $page }}
                            </button>
                        </div>
                    @elseif ($loop->index == $datos->currentPage() - 3 || $loop->index == $datos->currentPage() + 3)
                        <span class="mx-2">...</span>
                    @endif
                @endforeach

                <div class="btn-group" role="group" aria-label="Next group">
                    <!-- Botón para la página siguiente -->
                    <button type="button" class="btn btn-primary" wire:click="nextPage"
                        {{ $datos->hasMorePages() ? '' : 'disabled' }}>
                        Siguiente
                    </button>
                </div>
            </div>

        </div>
    </div>
    <!-- JavaScript -->
    <!-- JavaScript -->
    <script>
        function confirmAction(colaboradorId) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: '¿Quieres cambiar el estado de este colaborador?',
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


</div>
