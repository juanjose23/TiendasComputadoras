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
                        <a href="{{ route('precios.create') }}" class="btn btn-success btn-icon">
                            <i class="fas fa-plus"></i> Registrar producto
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
                        <li><a href="{{ route('exportprecios') }}" class="dropdown-item"><i
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

                    <th scope="col" class="px-4 py-3">Categoría</th>
                    <th scope="col" class="px-4 py-3">SubCategoría</th>
                    <th scope="col" class="px-4 py-3">Marca</th>
                    <th scope="col" class="px-4 py-3">Modelos</th>
                    <th scope="col" class="px-4 py-3">Nombre</th>
                    <th scope="col" class="px-4 py-3">Color</th>
                    <th scope="col" class="px-4 py-3">Precio</th>
                    <th scope="col" class="px-4 py-3">Estado</th>
                    <th scope="col" class="px-4 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>

                        <td>{{ $producto->productosdetalles->productos->subcategorias->categorias->nombre }}</td>
                        <td>{{ $producto->productosdetalles->productos->subcategorias->nombre }}</td>
                        <td>{{ $producto->productosdetalles->productos->modelos->marcas->nombre }}</td>
                        <td>{{ $producto->productosdetalles->productos->modelos->nombre }}</td>
                        <td>{{ $producto->productosdetalles->productos->nombre }}</td>

                        <td class="text-wrap">
                            {{ wordwrap($producto->productosdetalles->coloresproductos->colores->nombre, 50, "\n", true) }}</td>
                        <td>{{ $producto->precio }}
                        </td>

                        <td><span class="badge rounded-pill {{ $producto->estado == 1 ? 'bg-success' : 'bg-danger' }}">
                                {{ $producto->estado == 1 ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td>

                            <div class="d-flex mb-1 align-items-center">

                                <!-- Botón de información -->
                                <a href="{{ route('precios.show', ['precios' => $producto->id]) }}"
                                    class="btn btn-secondary me-1" role="button">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                @can('update', App\Models\Productos::class)
                                    <!-- Botón para editar -->
                                    <div class=" me-1">
                                        <a href="{{ route('precios.edit', ['precios' => $producto->id]) }}"
                                            class="btn btn-info btn-block" role="button">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                @endcan
                                @can('delete', App\Models\Productos::class)
                                    <!-- Botón para activar/desactivar -->
                                    <div class="flex me-1">
                                        @if ($producto->estado == 1)
                                            <button type="button"
                                                class="btn btn-{{ $producto->estado == 1 ? 'danger' : 'success' }} btn-block"
                                                role="button" onclick="confirmAction({{ $producto->id }})">
                                                <i class="fas fa-{{ $producto->estado == 1 ? 'trash-alt' : 'toggle-on' }}"></i>
                                            </button>
                                        @endif
                                    </div>
                                @endcan
                            </div>




                            <form id="deleteForm{{ $producto->id }}"
                                action="{{ route('precios.destroy', ['precios' => $producto->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <!-- Este botón no es visible, pero se utilizará para activar el SweetAlert -->
                                <button id="submitBtn{{ $producto->id }}" type="submit"
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
                        {{ $productos->onFirstPage() ? 'disabled' : '' }}>
                        &laquo; Previo
                    </button>
                </div>

                <!-- Botones para cada página -->
                @foreach ($productos->links() as $page => $url)
                    @if (
                        $loop->first ||
                            $loop->last ||
                            ($loop->index >= $productos->currentPage() - 2 && $loop->index <= $productos->currentPage() + 2))
                        <div class="btn-group me-2" role="group" aria-label="Page {{ $page }}">
                            <button type="button"
                                class="btn btn-primary {{ $productos->currentPage() == $page ? 'active' : '' }}"
                                wire:click="gotoPage({{ $page }})">
                                {{ $page }}
                            </button>
                        </div>
                    @elseif ($loop->index == $productos->currentPage() - 3 || $loop->index == $productos->currentPage() + 3)
                        <span class="mx-2">...</span>
                    @endif
                @endforeach

                <div class="btn-group" role="group" aria-label="Next group">
                    <!-- Botón para la página siguiente -->
                    <button type="button" class="btn btn-primary" wire:click="nextPage"
                        {{ $productos->hasMorePages() ? '' : 'disabled' }}>
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
    function confirmAction(productoId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Quieres cambiar el estado de este producto?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, cambiar estado'
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById('deleteForm' + productoId);

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
