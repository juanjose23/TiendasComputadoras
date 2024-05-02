<div>
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div class="input-group mb-3" style="max-width: 300px;">
            <input type="text" wire:model.live.debounce.300ms="buscar" class="form-control form-control rounded-start"
                placeholder="Buscar...">
        </div>

        <!-- Contenedor con alineación a la derecha -->
        <div class="d-flex justify-content-end flex-wrap mt-3 mt-md-0">
            <!-- Botón para crear un cargo -->
            @can('create', App\Models\Productos::class)
                <div class="dropdown">
                    <div class="btn-group ms-2 mb-2 mb-md-0">
                        <a href="{{ route('marcas.create') }}" class="btn btn-success btn-icon">
                            <i class="fas fa-plus"></i> Registrar Marca
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
                        <span class="sr-only">#</span>
                    </th>
                    <th scope="col" class="px-4 py-3">Nombre</th>
                    <th scope="col" class="px-4 py-3">Descripción</th>
                    <th scope="col" class="px-4 py-3">Pais de origen</th>
                    <th scope="col" class="px-4 py-3">Sitio web</th>
                    <th scope="col" class="px-4 py-3">Estado</th>
                    <th scope="col" class="px-4 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($Marcas as $marca)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>


                        <td>


                            @if ($marca->imagenes->isNotEmpty())
                                @foreach ($marca->imagenes as $imagen)
                                    <img src="{{ $imagen->url }}" width="36" height="36"
                                        class="rounded-circle me-2" alt="Charles Hall" alt="{{ $marca->nombre }}">
                                @endforeach
                            @endif
                            <span>{{ $marca->nombre }}</span>
                            <!-- Agrega el nombre de la marca junto a la imagen -->

                        </td>
                        <td class="text-wrap">{{ wordwrap($marca->descripcion, 50, "\n", true) }}</td>

                        <td>{{ $marca->paises->nombre }}</td>
                        <td>{{ $marca->sitio_web }}</td>
                        <td><span class="badge rounded-pill {{ $marca->estado == 1 ? 'bg-success' : 'bg-danger' }}">
                                {{ $marca->estado == 1 ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td>

                            <div class="d-flex mb-1 align-items-center">
                          
                                @can('update', App\Models\Productos::class)
                                    <!-- Botón para editar -->
                                    <div class=" me-1">
                                        <a href="{{ route('marcas.edit', ['marcas' => $marca->id]) }}"
                                            class="btn btn-info btn-block" role="button">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                @endcan

                                @can('delete', App\Models\productos::class)
                                    <!-- Botón para activar/desactivar -->
                                    <div class="flex me-1">
                                        <button type="button"
                                            class="btn btn-{{ $marca->estado == 1 ? 'danger' : 'success' }} btn-block"
                                            role="button" onclick="confirmAction({{ $marca->id }})">
                                            <i class="fas fa-{{ $marca->estado == 1 ? 'trash-alt' : 'toggle-on' }}"></i>
                                        </button>
                                    </div>
                                @endcan
                            </div>




                            <form id="deleteForm{{ $marca->id }}"
                                action="{{ route('marcas.destroy', ['marcas' => $marca->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <!-- Este botón no es visible, pero se utilizará para activar el SweetAlert -->
                                <button id="submitBtn{{ $marca->id }}" type="submit"
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
                        {{ $Marcas->onFirstPage() ? 'disabled' : '' }}>
                        &laquo; Previo
                    </button>
                </div>

                <!-- Botones para cada página -->
                @foreach ($Marcas->links() as $page => $url)
                    @if (
                        $loop->first ||
                            $loop->last ||
                            ($loop->index >= $Marcas->currentPage() - 2 && $loop->index <= $Marcas->currentPage() + 2))
                        <div class="btn-group me-2" role="group" aria-label="Page {{ $page }}">
                            <button type="button"
                                class="btn btn-primary {{ $Marcas->currentPage() == $page ? 'active' : '' }}"
                                wire:click="gotoPage({{ $page }})">
                                {{ $page }}
                            </button>
                        </div>
                    @elseif ($loop->index == $Marcas->currentPage() - 3 || $loop->index == $Marcas->currentPage() + 3)
                        <span class="mx-2">...</span>
                    @endif
                @endforeach

                <div class="btn-group" role="group" aria-label="Next group">
                    <!-- Botón para la página siguiente -->
                    <button type="button" class="btn btn-primary" wire:click="nextPage"
                        {{ $Marcas->hasMorePages() ? '' : 'disabled' }}>
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
