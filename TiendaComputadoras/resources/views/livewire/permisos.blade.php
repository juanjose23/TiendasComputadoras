<div >
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div class="input-group mb-3" style="max-width: 300px;">
            <input type="text" wire:model.live.debounce.300ms="buscar" class="form-control form-control rounded-start"
                placeholder="Buscar...">
        </div>

        <!-- Contenedor con alineación a la derecha -->
        <div class="d-flex justify-content-end flex-wrap mt-3 mt-md-0">
            <!-- Botón para crear un cargo -->
            <div class="dropdown">
                <div class="btn-group ms-2 mb-2 mb-md-0">
                    <a href="{{ route('permisos.create') }}" class="btn btn-success btn-icon">
                        <i class="bi bi-file-earmark-plus-fill"></i> Asignar permiso 
                    </a>
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
                    <th scope="col" class="px-4 py-3">Rol</th>
                    <th scope="col" class="px-4 py-3">N° de permisos</th>
                    <th scope="col" class="px-4 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($roles as $rol)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $rol->roles->nombre }}</td>
                        <td class="text-center">{{ wordwrap($rol->cantidad, 50, "\n", true) }}</td>
                        <td>
                            <div class="d-flex mb-1 align-items-center">
                                <a href="{{ route('permisos.edit', ['permisos' => $rol->roles->id]) }}"
                                    class="btn btn-info" role="button">
                                    <i class="bi bi-pencil"></i>

                                </a>
                           

                            <div class="m-1">
                                <a href="{{ route('permisos.show', ['permisos' => $rol->roles->id]) }}"
                                    class="btn btn-secondary" role="button">
                                    <i class="bi bi-eye"></i>
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
