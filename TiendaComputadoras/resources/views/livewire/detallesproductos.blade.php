<div>

    <table class="table table-sm mt-2 mb-4">
        <thead>
            <tr>
                <th>#</th>
                <th>Género</th>
                <th>Corte</th>
                <th>Talla</th>
                <th>Color</th>
                <th>Muestras</th>
                <th>Estado</th>
                <th>Fecha de registro</th>
                <th>Fecha de actualización</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detalle as $detalles)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $detalles->generos->nombre }}</td>
                    <td>{{ $detalles->cortesproductos->cortes->nombre }}</td>
                    <td>{{ $detalles->tallasproductos->tallas->nombre }}</td>
                    <td>{{ $detalles->coloresproductos->colores->nombre }}</td>
                    <td>
                        <span class="badge rounded-pill">
                            <div
                                style="width: 20px; height: 20px; border-radius: 50%; background-color:{{ $detalles->coloresproductos->colores->codigo }}">
                            </div>
                        </span>
                    </td>

                    <td>
                        <span class="badge rounded-pill {{ $detalles->estado == 1 ? 'bg-success' : 'bg-danger' }}">
                            {{ $detalles->estado == 1 ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                    <td>{{ $detalles->created_at }}</td>
                    <td>{{ $detalles->updated_at }}</td>
                    <td>
                        <div class="btn-group d-flex align-items-start">
                            @can('delete', App\Models\Productos::class)
                                <div class="mb-3 me-2">
                                    <button type="button"
                                        class="btn btn-{{ $detalles->estado == 1 ? 'danger' : 'success' }} btn-block"  onclick="confirmAction({{ $detalles->id }})">
                                        <i class="fas fa-{{ $detalles->estado == 1 ? 'trash' : 'power' }}"></i>
                                    </button>
                                    <form id="deleteForm{{ $detalles->id }}"
                                        action="{{ route('productos.destroydetalles', ['id' => $detalles->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="text" name="id" value={{ $detalles->id }} hidden>
                                        <!-- Este botón no es visible, pero se utilizará para activar el SweetAlert -->
                                        <button id="submitBtn{{ $detalles->id }}" type="submit"
                                            style="display: none;"></button>
                                    </form>
                                </div>
                            @endcan
                            @can('update', App\Models\Productos::class)
                                <div class="dropdown">
                                    <button id="infoDropdown" type="button" class="btn btn-info dropdown-toggle "
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="align-middle me-1" data-feather="settings"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="infoDropdown">
                                        <a class="dropdown-item"
                                            href="{{ route('coloresproductos.edit', ['coloresproductos' => $detalles->id]) }}">
                                            <i class="align-middle me-2" data-feather="droplet" style="color:red;"></i>
                                            Nuevo color
                                        </a>
                                        <a class="dropdown-item"
                                            href="{{ route('productos.agregarCorte', ['id' => $detalles->id]) }}">
                                            <i class="align-middle me-2" data-feather="crop" style="color:aqua"></i> Nueva
                                            Corte
                                        </a>
                                        <a class="dropdown-item"
                                            href="{{ route('productos.agregartallas', ['id' => $detalles->id]) }}">
                                            <i class="align-middle me-2" data-feather="tag" style="color:black;"></i> Nueva
                                            talla
                                        </a>
                                    </div>
                                </div>
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
                    {{ $detalle->onFirstPage() ? 'disabled' : '' }}>
                    &laquo; Previo
                </button>
            </div>

            <!-- Botones para cada página -->
            @foreach ($detalle->links() as $page => $url)
                @if (
                    $loop->first ||
                        $loop->last ||
                        ($loop->index >= $detalle->currentPage() - 2 && $loop->index <= $detalle->currentPage() + 2))
                    <div class="btn-group me-2" role="group" aria-label="Page {{ $page }}">
                        <button type="button"
                            class="btn btn-primary {{ $detalle->currentPage() == $page ? 'active' : '' }}"
                            wire:click="gotoPage({{ $page }})">
                            {{ $page }}
                        </button>
                    </div>
                @elseif ($loop->index == $detalle->currentPage() - 3 || $loop->index == $detalle->currentPage() + 3)
                    <span class="mx-2">...</span>
                @endif
            @endforeach

            <div class="btn-group" role="group" aria-label="Next group">
                <!-- Botón para la página siguiente -->
                <button type="button" class="btn btn-primary" wire:click="nextPage"
                    {{ $detalle->hasMorePages() ? '' : 'disabled' }}>
                    Siguiente
                </button>
            </div>
        </div>
    </div>

</div>
