<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0 text-black">Lista de proveedores</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div class="input-group mb-3" style="max-width: 300px;">
                            <input type="text" wire:model.live.debounce.300ms="buscar"
                                class="form-control form-control rounded-start" placeholder="Buscar...">
                        </div>

                        <!-- Contenedor con alineación a la derecha -->
                        <div class="d-flex justify-content-end flex-wrap mt-3 mt-md-0">
                            <!-- Botón para crear un cargo -->
                            @can('create', App\Models\Proveedores::class)
                                <div class="dropdown">
                                    <div class="btn-group ms-2 mb-2 mb-md-0">
                                        <a href="{{ route('proveedores.create') }}" class="btn btn-success btn-icon">
                                            <i class="fas fa-plus"></i> Registrar proveedor
                                        </a>
                                    </div>
                                </div>
                            @endcan

                            <!-- Botón de exportación -->
                            <div class="btn-group ms-2 mb-2 mb-md-0">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle btn-icon" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Exportaciones
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('exportproveedores') }}" class="dropdown-item"><i
                                                    class="fas fa-file-excel text-success"></i>
                                                Exportar a Excel</a></li>


                                    </ul>
                                </div>
                            </div>

                            <!-- Botón para seleccionar cantidad de registros a mostrar -->
                            <div class="ms-2">
                                <select name="buscador" id="buscador" wire:model.live="perPage"
                                    class="form-select mt-2 mt-md-0">
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
                                    <th scope="col" class="px-4 py-3">Nombre</th>
                                    <th scope="col" class="px-4 py-3">Razon Social</th>
                                    <th scope="col" class="px-4 py-3">Lineas de abastecimiento</th>
                                    <th scope="col" class="px-4 py-3">Estado</th>
                                    <th scope="col" class="px-4 py-3">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($proveedores as $proveedor)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>


                                        <td>

                                            {{ $proveedor->personas->nombre }}


                                        </td>

                                        <td>
                                          {{  isset($proveedor->personas->persona_naturales->apellido) ?  $proveedor->personas->persona_naturales->apellido : $proveedor->personas->persona_juridicas->razon_social}}
                                        </td>

                                        <td>Ropa de {{ $proveedor->sector_comercial }}</td>
                                        <td><span
                                                class="badge rounded-pill {{ $proveedor->estado == 1 ? 'bg-success' : 'bg-danger' }}">
                                                {{ $proveedor->estado == 1 ? 'Activo' : 'Inactivo' }}
                                            </span>
                                        </td>
                                        <td>

                                            <div class="d-flex mb-1 align-items-center">
                                                <a href="{{ route('proveedores.show', ['proveedores' => $proveedor->id]) }}"
                                                    class="btn btn-secondary me-1" role="button">
                                                    <i class="fas fa-info"></i>
                                                </a>
                                                @can('update', App\Models\Proveedores::class)
                                                    <!-- Botón para editar -->
                                                    <div class=" me-1">
                                                        <a href="{{ route('proveedores.edit', ['proveedores' => $proveedor->id]) }}"
                                                            class="btn btn-info btn-block" role="button">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </div>
                                                @endcan
                                                @can('delete', App\Models\Proveedores::class)
                                                    <!-- Botón para activar/desactivar -->
                                                    <div class="flex me-1">
                                                        <button type="button"
                                                            class="btn btn-{{ $proveedor->estado == 1 ? 'danger' : 'success' }} btn-block"
                                                            role="button" onclick="confirmAction({{ $proveedor->id }})">
                                                            <i
                                                                class="fas fa-{{ $proveedor->estado == 1 ? 'trash-alt' : 'toggle-on' }}"></i>
                                                        </button>
                                                    </div>
                                                @endcan
                                            </div>




                                            <form id="deleteForm{{ $proveedor->id }}"
                                                action="{{ route('proveedores.destroy', ['proveedores' => $proveedor->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <!-- Este botón no es visible, pero se utilizará para activar el SweetAlert -->
                                                <button id="submitBtn{{ $proveedor->id }}" type="submit"
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
                                        {{ $proveedores->onFirstPage() ? 'disabled' : '' }}>
                                        &laquo; Previo
                                    </button>
                                </div>

                                <!-- Botones para cada página -->
                                @foreach ($proveedores->links() as $page => $url)
                                    @if (
                                        $loop->first ||
                                            $loop->last ||
                                            ($loop->index >= $proveedores->currentPage() - 2 && $loop->index <= $proveedores->currentPage() + 2))
                                        <div class="btn-group me-2" role="group"
                                            aria-label="Page {{ $page }}">
                                            <button type="button"
                                                class="btn btn-primary {{ $proveedores->currentPage() == $page ? 'active' : '' }}"
                                                wire:click="gotoPage({{ $page }})">
                                                {{ $page }}
                                            </button>
                                        </div>
                                    @elseif ($loop->index == $proveedores->currentPage() - 3 || $loop->index == $proveedores->currentPage() + 3)
                                        <span class="mx-2">...</span>
                                    @endif
                                @endforeach

                                <div class="btn-group" role="group" aria-label="Next group">
                                    <!-- Botón para la página siguiente -->
                                    <button type="button" class="btn btn-primary" wire:click="nextPage"
                                        {{ $proveedores->hasMorePages() ? '' : 'disabled' }}>
                                        Siguiente
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    function confirmAction(ProveedoresId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Quieres cambiar el estado de este proveedor?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, cambiar estado'
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById('deleteForm' + ProveedoresId);

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
