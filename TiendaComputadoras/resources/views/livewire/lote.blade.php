<div>
    <style>
        .sortable:hover {
            cursor: pointer;
            text-decoration: none;
            color: black;
        }

        .sort-icon {
            margin-left: 5px;
        }
    </style>
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div class="input-group mb-3" style="max-width: 300px;">
            <input type="text" wire:model.live.debounce.300ms="buscar" class="form-control form-control rounded-start"
                placeholder="Buscar...">
        </div>

        <!-- Contenedor con alineación a la derecha -->
        <div class="d-flex justify-content-end flex-wrap mt-3 mt-md-0">
            <!-- Botón para crear un cargo -->
            @can('create', App\Models\Proveedores::class)
                <div class="dropdown">
                    <div class="btn-group ms-2 mb-2 mb-md-0">
                        <a href="{{ route('lotes.create') }}" class="btn btn-success btn-icon">
                            <i class="fas fa-plus"></i> Registrar Lote
                        </a>
                    </div>
                </div>
            @endcan

            <!-- Botón de exportación -->
            <div class="btn-group ms-2 mb-2 mb-md-0">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle btn-icon" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Exportaciones
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('exportmarcas') }}" class="dropdown-item"><i
                                    class="fas fa-file-excel text-success"></i>
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
                        <a style="  color: black;   " wire:click="sortBy('numero_lote')" class="sortable">
                            N°
                            @if ($sortColumn == 'numero_lote')
                                @if ($sortDirection == 'asc')
                                    <i class="fas fa-sort-up sort-icon"></i>
                                @else
                                    <i class="fas fa-sort-down sort-icon"></i>
                                @endif
                            @else
                                <i class="fas fa-sort sort-icon"></i>
                            @endif
                        </a>
                    </th>
                    <th scope="col" class="px-4 py-3">Proveedor </th>
                    <th scope="col" class="px-4 py-3">Registrado por</th>
                    <th scope="col" class="px-4 py-3">Subtotal</th>
                    <th scope="col" class="px-4 py-3">IVA</th>
                    <th scope="col" class="px-4 py-3">Total</th>
                    <th scope="col" class="px-4 py-3">Estado</th>
                    <th scope="col" class="px-4 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($Lotes as $lote)
                    <tr>
                        <td>{{ $lote->numero_lote }}</td>
                        <td>{{ $lote->proveedores->personas->nombre }}</td>
                    
                        <td>{{ $lote->empleados->personas->nombre }}</td>
                        <td>{{ $lote->subtotal }}</td>
                        <td>{{ $lote->iva }}</td>
                        <td>{{ $lote->total }}</td>

                        <td><span class="badge rounded-pill {{ $lote->estado == 1 ? 'bg-success' : 'bg-danger' }}">
                                {{ $lote->estado == 1 ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td>

                            <div class="d-flex mb-1 align-items-center">

                                @can('update', App\Models\Productos::class)
                                    <!-- Botón para editar -->
                                    <div class=" me-1">
                                        <a href="{{ route('lotes.show', ['lotes' => $lote->id]) }}"
                                            class="btn btn-info btn-block" role="button">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                @endcan

                                @can('delete', App\Models\productos::class)
                                    <!-- Botón para activar/desactivar -->
                                    <div class="flex me-1">
                                        <button type="button"
                                            class="btn btn-{{ $lote->estado == 1 ? 'danger' : 'success' }} btn-block"
                                            role="button" onclick="confirmAction({{ $lote->id }})">
                                            <i class="fas fa-{{ $lote->estado == 1 ? 'trash-alt' : 'toggle-on' }}"></i>
                                        </button>
                                    </div>
                                @endcan
                            </div>




                            <form id="deleteForm{{ $lote->id }}"
                                action="{{ route('lotes.destroy', ['lotes' => $lote->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <!-- Este botón no es visible, pero se utilizará para activar el SweetAlert -->
                                <button id="submitBtn{{ $lote->id }}" type="submit"
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
                        {{ $Lotes->onFirstPage() ? 'disabled' : '' }}>
                        &laquo; Previo
                    </button>
                </div>

                <!-- Botones para cada página -->
                @foreach ($Lotes->links() as $page => $url)
                    @if (
                        $loop->first ||
                            $loop->last ||
                            ($loop->index >= $Marcas->currentPage() - 2 && $loop->index <= $Lotes->currentPage() + 2))
                        <div class="btn-group me-2" role="group" aria-label="Page {{ $page }}">
                            <button type="button"
                                class="btn btn-primary {{ $Lotes->currentPage() == $page ? 'active' : '' }}"
                                wire:click="gotoPage({{ $page }})">
                                {{ $page }}
                            </button>
                        </div>
                    @elseif ($loop->index == $Lotes->currentPage() - 3 || $loop->index == $Lotes->currentPage() + 3)
                        <span class="mx-2">...</span>
                    @endif
                @endforeach

                <div class="btn-group" role="group" aria-label="Next group">
                    <!-- Botón para la página siguiente -->
                    <button type="button" class="btn btn-primary" wire:click="nextPage"
                        {{ $Lotes->hasMorePages() ? '' : 'disabled' }}>
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
    function confirmAction(MarcasId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Quieres cambiar el estado de esta  marca?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, cambiar estado'
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById('deleteForm' + MarcasId);

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
