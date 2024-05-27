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
                        <a href="{{ route('roles.create') }}" class="btn btn-success btn-icon">
                            <i class="fas fa-plus"></i> Crear rol
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
                        <li><a href="{{ route('exportroles') }}" class="dropdown-item"><i
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

                    <th scope="col" class="px-4 py-3">Cargo</th>

                    <th scope="col" class="px-4 py-3">Descripción</th>
                    <th scope="col" class="px-4 py-3">Estado</th>
                    <th scope="col" class="px-4 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($roles as $rol)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>


                        <td>{{ $rol->nombre }}</td>

                        <td class="text-wrap">{{ wordwrap($rol->descripcion, 50, "\n", true) }}</td>
                        <td><span class="badge rounded-pill {{ $rol->estado == 1 ? 'bg-success' : 'bg-danger' }}">
                                {{ $rol->estado == 1 ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td>

                            <div class="d-flex mb-1 align-items-center">
                                @can('update', App\Models\permisos::class)
                                    <a href="{{ route('roles.edit', ['roles' => $rol->id]) }}" class="btn btn-info d-block"
                                        role="button">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endcan
                                @can('delete', App\Models\permisos::class)
                                    <div class="m-1">
                                        <!-- Botón para activar/desactivar -->
                                        <button type="button"
                                            class="btn btn-{{ $rol->estado == 1 ? 'danger' : 'success' }} d-block"
                                            role="button" onclick="confirmAction({{ $rol->id }})">
                                            <i class="fas fa-{{ $rol->estado == 1 ? 'trash-alt' : 'toggle-on' }}"></i>

                                        </button>
                                    </div>
                                @endcan
                            </div>

                            <form id="deleteForm{{ $rol->id }}"
                                action="{{ route('roles.destroy', ['roles' => $rol->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <!-- Este botón no es visible, pero se utilizará para activar el SweetAlert -->
                                <button id="submitBtn{{ $rol->id }}" type="submit"
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
                        {{ $roles->onFirstPage() ? 'disabled' : '' }}>
                        &laquo; Previo
                    </button>
                </div>

                <!-- Botones para cada página -->
                @foreach ($roles->links() as $page => $url)
                    @if (
                        $loop->first ||
                            $loop->last ||
                            ($loop->index >= $roles->currentPage() - 2 && $loop->index <= $roles->currentPage() + 2))
                        <div class="btn-group me-2" role="group" aria-label="Page {{ $page }}">
                            <button type="button"
                                class="btn btn-primary {{ $roles->currentPage() == $page ? 'active' : '' }}"
                                wire:click="gotoPage({{ $page }})">
                                {{ $page }}
                            </button>
                        </div>
                    @elseif ($loop->index == $roles->currentPage() - 3 || $loop->index == $roles->currentPage() + 3)
                        <span class="mx-2">...</span>
                    @endif
                @endforeach

                <div class="btn-group" role="group" aria-label="Next group">
                    <!-- Botón para la página siguiente -->
                    <button type="button" class="btn btn-primary" wire:click="nextPage"
                        {{ $roles->hasMorePages() ? '' : 'disabled' }}>
                        Siguiente
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- JavaScript -->
<!-- JavaScript -->
<script>
    function confirmAction(rolId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Quieres cambiar el estado de este rol?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, cambiar estado'
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById('deleteForm' + rolId);

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
