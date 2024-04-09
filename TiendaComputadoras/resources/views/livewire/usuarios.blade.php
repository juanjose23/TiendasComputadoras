<div>
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div class="input-group mb-3" style="max-width: 300px;">
            <input type="text" wire:model.live.debounce.300ms="buscar" class="form-control form-control rounded-start"
                placeholder="Buscar...">
        </div>

        <!-- Contenedor con alineación a la derecha -->
        <div class="d-flex justify-content-end flex-wrap mt-3 mt-md-0">
            <!-- Botón para crear un cargo -->
            @can('create', App\Models\permisos::class)
                <div class="dropdown">
                    <div class="btn-group ms-2 mb-2 mb-md-0">
                        <a href="{{ route('usuarios.create') }}" class="btn btn-success btn-icon">
                            <i class="bi bi-file-earmark-plus-fill"></i> Registrar usuario
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
                        <li><a class="dropdown-item" href="{{ route('exportusuarios') }}"><i
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
                    <th scope="col" class="px-4 py-3">Usuario</th>
                    <th scope="col" class="px-4 py-3">Estado</th>
                    <th scope="col" class="px-4 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>


                @foreach ($usuarios as $colaborador)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $colaborador->personas->empleados->codigo }}</td>

                        <td>{{ $colaborador->personas->nombre }}</td>
                        <td>{{ $colaborador->personas->persona_naturales->apellido }}</td>
                        <td>{{ $colaborador->usuario }}</td>
                        <td>
                            <span
                                class="badge rounded-pill {{ $colaborador->estado == 1 ? 'bg-success' : ($colaborador->estado == 2 ? 'bg-warning' : 'bg-danger') }}">
                                {{ $colaborador->estado == 1 ? 'Activo' : ($colaborador->estado == 2 ? 'Verificar' : 'Inactivo') }}
                            </span>
                        </td>

                        <td>

                            <div class="d-flex mb-1 align-items-center">
                                @can('update', App\Models\permisos::class)
                                    <a href="{{ route('usuarios.edit', ['usuarios' => $colaborador->id]) }}"
                                        class="btn btn-info" role="button">
                                        <i class="bi bi-pencil"></i>

                                    </a>
                                @endcan

                                @can('delete', App\Models\permisos::class)
                                <div class="m-1">
                                    <!-- Botón para activar/desactivar -->
                                    <button type="button"
                                        class="btn btn-{{ $colaborador->estado == 1 ? 'danger' : 'success' }} d-block"
                                        role="button" onclick="confirmAction({{ $colaborador->id }})">
                                        <i class="bi bi-{{ $colaborador->estado == 1 ? 'trash' : 'power' }}"></i>

                                    </button>
                                </div>
                                @endcan
                            </div>



                            <form id="deleteForm{{ $colaborador->id }}"
                                action="{{ route('usuarios.destroy', ['usuarios' => $colaborador->id]) }}"
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

        <div class="mt-4">
            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group me-2" role="group" aria-label="First group">
                    <!-- Botón para la página anterior -->
                    <button type="button" class="btn btn-primary" wire:click="previousPage"
                        {{ $usuarios->onFirstPage() ? 'disabled' : '' }}>
                        Previo
                    </button>
                </div>

                <!-- Botones para cada página -->
                @foreach ($usuarios->links() as $page => $url)
                    @if (
                        $loop->first ||
                            $loop->last ||
                            ($loop->index >= $usuarios->currentPage() - 2 && $loop->index <= $usuarios->currentPage() + 2))
                        <div class="btn-group me-2" role="group" aria-label="Page {{ $page }}">
                            <button type="button"
                                class="btn btn-primary {{ $usuarios->currentPage() == $page ? 'active' : '' }}"
                                wire:click="gotoPage({{ $page }})">
                                {{ $page }}
                            </button>
                        </div>
                    @elseif ($loop->index == $usuarios->currentPage() - 3 || $loop->index == $usuarios->currentPage() + 3)
                        <span class="mx-2">...</span>
                    @endif
                @endforeach

                <div class="btn-group" role="group" aria-label="Next group">
                    <!-- Botón para la página siguiente -->
                    <button type="button" class="btn btn-primary" wire:click="nextPage"
                        {{ $usuarios->hasMorePages() ? '' : 'disabled' }}>
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
                text: '¿Quieres cambiar el estado de este usuario?',
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
