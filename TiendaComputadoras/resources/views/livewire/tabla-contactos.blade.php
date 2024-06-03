<div>
    <br>
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div class="input-group mb-3" style="max-width: 300px;">
            <input type="text" wire:model.live.debounce.300ms="buscar" class="form-control form-control rounded-start"
                placeholder="Buscar...">
        </div>

        <!-- Contenedor con alineación a la derecha -->
        <div class="d-flex justify-content-end flex-wrap mt-3 mt-md-0">

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
                    <th scope="col" class="px-4 py-3">Télefono</th>
                    <th scope="col" class="px-4 py-3">Correo</th>
                    <th scope="col" class="px-4 py-3">Cargo</th>
                    <th scope="col" class="px-4 py-3">Estado</th>
                    <th scope="col" class="px-4 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($proveedores as $colaborador)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>


                        <td>{{ $colaborador->personas->nombre }}</td>
                        <td>{{ $colaborador->personas->telefono }}</td>
                        <td>{{ $colaborador->personas->correo }}</td>
                        <td>{{ $colaborador->cargo }}</td>
                        <td><span
                                class="badge rounded-pill {{ $colaborador->estado == 1 ? 'bg-success' : 'bg-danger' }}">
                                {{ $colaborador->estado == 1 ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td>

                            <div class="d-flex mb-1 align-items-center">

                                @can('update', App\Models\Proveedores::class)
                                    <button type="button" class="btn btn-warning"
                                        wire:click="editarContacto({{ $colaborador->id }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                @endcan
                                <div class="modal fade" id="modal-edicion" tabindex="-1" role="dialog"
                                    aria-labelledby="modal-edicion-titulo">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal-edicion-titulo">Editar contacto</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form wire:submit.prevent="actualizarContacto">
                                                    <div class="form-group">
                                                        <label for="nombre">Nombre:</label>
                                                        <input type="text"
                                                            class="form-control @error('nombre') is-invalid @enderror"
                                                            id="nombre" wire:model="nombre">
                                                        @error('nombre')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="telefono">Teléfono:</label>
                                                        <input type="text"
                                                            class="form-control @error('telefono') is-invalid @enderror"
                                                            id="telefono" wire:model="telefono">
                                                        @error('telefono')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="correo">Correo:</label>
                                                        <input type="email"
                                                            class="form-control @error('correo') is-invalid @enderror"
                                                            id="correo" wire:model="correo">
                                                        @error('correo')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="cargo">Cargo:</label>
                                                        <input type="text"
                                                            class="form-control @error('cargo') is-invalid @enderror"
                                                            id="cargo" wire:model="cargo">
                                                        @error('cargo')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Actualizar
                                                            contacto</button>
                                                    </div>
                                                    <!-- Botón de submit para actualizar el contacto -->
                                                 
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>





                                @can('delete', App\Models\Proveedores::class)
                                    <div class="m-1">
                                        <button type="button"
                                            class="btn btn-{{ $colaborador->estado == 1 ? 'danger' : 'success' }}"
                                            wire:click="$dispatch('confirmar-cambio-estado', {{ $colaborador->id }})">
                                            <i
                                                class="fas fa-{{ $colaborador->estado == 1 ? 'trash-alt' : 'toggle-on' }}"></i>
                                        </button>

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
                        {{ $proveedores->onFirstPage() ? 'disabled' : '' }}>
                        Previo
                    </button>
                </div>

                <!-- Botones para cada página -->
                @foreach ($proveedores->links() as $page => $url)
                    @if (
                        $loop->first ||
                            $loop->last ||
                            ($loop->index >= $proveedores->currentPage() - 2 && $loop->index <= $proveedores->currentPage() + 2))
                        <div class="btn-group me-2" role="group" aria-label="Page {{ $page }}">
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


    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('confirmar-cambio-estado', Id => {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'Estás a punto de cambiar el estado de este registro. ¿Estás seguro de continuar?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, cambiar estado',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.call('cambiarEstado', Id);
                    }
                });
            });
            window.addEventListener('estado-cambiado', event => {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Se ha cambiado con estado con éxito',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                });
            });
            Livewire.on('mostrar-modal-edicion', () => {
                $('#modal-edicion').modal('show');
            });
            window.addEventListener('cerrar-modal-edicion', event => {
                $('#modal-edicion').modal('hide');
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Se ha actualizado  con éxito',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                });
            });


        });
    </script>



</div>
