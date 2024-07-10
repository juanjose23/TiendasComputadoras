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
            @can('create', App\Models\Solicitud_compra::class)
                <div class="dropdown">
                    <div class="btn-group ms-2 mb-2 mb-md-0">
                        <a href="{{ route('solicitud.create') }}" class="btn btn-success btn-icon">
                            <i class="fas fa-plus"></i> Registrar Solicitud
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
                        #
                    </th>
                    <th scope="col" class="px-4 py-3">Solicitado por</th>
                    <th scope="col" class="px-4 py-3">Notas</th>
                    <th scope="col" class="px-4 py-3">Fechas de Entrega esperada</th>
                    <th scope="col" class="px-4 py-3">Estado</th>
                    <th scope="col" class="px-4 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($Solicitudes as $lote)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $lote->empleados->personas->nombre }}</td>



                        <td>{{ $lote->notas }}</td>
                        <td>{{ $lote->fecha_entrega_esperada }}</td>
                        <td>
                            @switch($lote->estado)
                                @case(0)
                                    <span class="badge rounded-pill bg-danger">
                                        Inactivo
                                    </span>
                                @break

                                @case(1)
                                    <span class="badge rounded-pill bg-warning">
                                        Solicitud en proceso
                                    </span>
                                @break

                                @case(2)
                                    <span class="badge rounded-pill bg-success">
                                        Solicitud aceptada
                                    </span>
                                @break

                                @default
                                    <span class="badge rounded-pill bg-secondary">
                                        Estado desconocido
                                    </span>
                            @endswitch

                        </td>
                        <td>

                            <div class="d-flex mb-1 align-items-center">
                                @can('update', App\Models\Solicitud_compra::class)
                                    <!-- Botón para editar -->
                                    <div class=" me-1">
                                        <a href="{{ route('solicitud.show', ['solicitud' => $lote->id]) }}"
                                            class="btn dt-button-spacer btn-block" role="button">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                @endcan
                                @can('update', App\Models\Solicitud_compra::class)
                                    <!-- Botón para editar -->
                                    <div class=" me-1">
                                        <a href="{{ route('solicitud.edit', ['solicitud' => $lote->id]) }}"
                                            class="btn dt-button-spacer btn-block" role="button">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                @endcan

                                @can('delete', App\Models\Solicitud_compra::class)
                                    <!-- Botón para activar/desactivar -->
                                    @if ($lote->estado != 2)
                                        <div class="flex me-1">
                                            <button type="button" class="btn dt-button-spacer btn-block" role="button"
                                                onclick="confirmAction({{ $lote->id }})">
                                                <i class="fas fa-{{ $lote->estado == 1 ? 'trash-alt' : 'toggle-on' }}"></i>
                                            </button>
                                        </div>
                                    @endif
                                    <form id="deleteForm{{ $lote->id }}"
                                        action="{{ route('solicitud.destroy', ['solicitud' => $lote->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        @if ($lote->estado == 1)
                                            <input type="text" name="estado" id="" value="0" hidden>
                                        @elseif ($lote->estado == 0)
                                            <input type="text" name="estado" id="" value="1" hidden>
                                        @endif
                                        <!-- Este botón no es visible, pero se utilizará para activar el SweetAlert -->
                                        <button id="submitBtn{{ $lote->id }}" type="submit"
                                            style="display: none;"></button>
                                    </form>
                                @endcan
                                @can('restore', App\Models\Solicitud_compra::class)
                                    <!-- Botón para activar/desactivar -->
                                    @if ($lote->estado != 0)
                                        <div class="flex me-1">
                                            <button type="button" class="btn dt-button-spacer btn-block" role="button"
                                                onclick="confirmActions({{ $lote->id }})">
                                                <i class="fas fa-{{ $lote->estado == 1 ? 'toggle-on' : 'toggle-on' }}"></i>
                                            </button>
                                        </div>
                                    @endif
                                    <form id="activar{{ $lote->id }}"
                                        action="{{ route('solicitud.destroy', ['solicitud' => $lote->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="text" name="estado" id="" value="2" hidden>
                                        <!-- Este botón no es visible, pero se utilizará para activar el SweetAlert -->
                                        <button id="submitBtn{{ $lote->id }}" type="submit"
                                            style="display: none;"></button>
                                    </form>
                                @endcan
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
                        {{ $Solicitudes->onFirstPage() ? 'disabled' : '' }}>
                        &laquo; Previo
                    </button>
                </div>

                <!-- Botones para cada página -->
                @foreach ($Solicitudes->links() as $page => $url)
                    @if (
                        $loop->first ||
                            $loop->last ||
                            ($loop->index >= $Solicitudes->currentPage() - 2 && $loop->index <= $Solicitudes->currentPage() + 2))
                        <div class="btn-group me-2" role="group" aria-label="Page {{ $page }}">
                            <button type="button"
                                class="btn btn-primary {{ $Solicitudes->currentPage() == $page ? 'active' : '' }}"
                                wire:click="gotoPage({{ $page }})">
                                {{ $page }}
                            </button>
                        </div>
                    @elseif ($loop->index == $Solicitudes->currentPage() - 3 || $loop->index == $Solicitudes->currentPage() + 3)
                        <span class="mx-2">...</span>
                    @endif
                @endforeach

                <div class="btn-group" role="group" aria-label="Next group">
                    <!-- Botón para la página siguiente -->
                    <button type="button" class="btn btn-primary" wire:click="nextPage"
                        {{ $Solicitudes->hasMorePages() ? '' : 'disabled' }}>
                        Siguiente
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function confirmAction(MarcasId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Quieres actualizar esta solicitud?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí'
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
<script>
    function confirmActions(MarcasId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Quieres Aceptar la solicitud?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById('activar' + MarcasId);

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
