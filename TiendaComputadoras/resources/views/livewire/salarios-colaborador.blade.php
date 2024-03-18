<div wire:poll.1s>
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div class="input-group mb-3" style="max-width: 300px;">
            <input type="text" wire:model.live.debounce.300ms="Filtrar" class="form-control form-control rounded-start"
                placeholder="Buscar...">
        </div>

        <!-- Contenedor con alineación a la derecha -->
        <div class="d-flex justify-content-end flex-wrap mt-3 mt-md-0">
            <!-- Botón para crear un cargo -->
            <div class="dropdown">
                <div class="btn-group ms-2 mb-2 mb-md-0">
                    <a href="{{ route('salarios.create') }}" class="btn btn-success btn-icon">
                        <i class="bi bi-file-earmark-plus-fill"></i> Registrar Salario
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
                        <li><a class="dropdown-item" href="{{ route('exportsalarios') }}"><i
                                    class="bi bi-file-earmark-spreadsheet text-success"></i>
                                Exportar a Excel</a></li>
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
                    <th scope="col" class="px-4 py-3">Salario</th>
                    <th scope="col" class="px-4 py-3">Estado</th>
                    <th scope="col" class="px-4 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $colaborador)
                    <tr>


                        <td>{{ $loop->index }}</td>
                        <td>{{ $colaborador->empleados->codigo }}</td>

                        <td>{{ $colaborador->empleados->personas->nombre }}</td>
                        <td>{{ $colaborador->empleados->personas->persona_naturales->apellido }}</td>
                        <td>{{ $colaborador->salario }}</td>
                        <td><span
                                class="badge rounded-pill {{ $colaborador->estado == 1 ? 'bg-success' : 'bg-danger' }}">
                                {{ $colaborador->estado == 1 ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td>

                            <div class="d-flex">
                                <div class="mr-2">
                                    <a href="{{ route('salarios.edit', ['salarios' => $colaborador->empleados->id]) }}"
                                        class="btn btn-info" role="button">
                                        <i class="bi bi-pencil"></i>

                                    </a>
                                </div>

                            </div>



                            

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
