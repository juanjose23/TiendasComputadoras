@extends('layout.layout')
@section('title', 'Precios')
@section('submodulo', 'Historial de precios')
@section('content')
    <div class="container-fluid p-0">
        <h3 class="h3 mb-3">Lista del precios</h3>
        <div class="row">
            <div class="col-12">
                <div class="">
                    <div class="card-header">
                        <h5 class="card-title mb-0 text-black">Especificaciones del Producto</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li><strong>Producto:</strong> {{ $precio->productosdetalles->productos->nombre }}</li>
                            <li><strong>Código:</strong> {{ $precio->productosdetalles->productos->codigo }}</li>
                            <li><strong>Categoría / Subcategoría:</strong>
                                {{ $precio->productosdetalles->productos->subcategorias->categorias->nombre }} /
                                {{ $precio->productosdetalles->productos->subcategorias->nombre }}</li>
                            <li><strong>Marca / Modelo:</strong>
                                {{ $precio->productosdetalles->productos->modelos->marcas->nombre }} /
                                {{ $precio->productosdetalles->productos->modelos->nombre }}</li>
                           
                            <li><strong>Color:</strong> {{ $precio->productosdetalles->coloresproductos->colores->nombre }}</li>
                            <li><strong>Corte:</strong> {{ $precio->productosdetalles->cortesproductos->cortes->nombre }}</li>
                            <li><strong>Talla:</strong> {{ $precio->productosdetalles->tallasproductos->tallas->nombre }}</li>
                            <li><strong>Género:</strong> {{ $precio->productosdetalles->generos->nombre }}</li>
                            <!-- Agrega más especificaciones según sea necesario -->
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col" class="px-4 py-3">
                                          #
                                        </th>

                                        <th scope="col" class="px-4 py-3">Precio</th>
                                        <th scope="col" class="px-4 py-3">Fecha de registro</th>
                                        <th scope="col" class="px-4 py-3">Fecha de Actualizacion</th>
                                        <th scope="col" class="px-4 py-3">Estado</th>
                                        <th scope="col" class="px-4 py-3">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($historial as $colaborador)
                                        <tr>
                                            <td>{{ $loop->index +1 }}</td>

                                            <td>{{ $colaborador->precio }}</td>
                                            <td>{{ $colaborador->created_at }}</td>
                                            <td>{{ $colaborador->updated_at }}</td>
                                            <td><span
                                                    class="badge rounded-pill {{ $colaborador->estado == 1 ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $colaborador->estado == 1 ? 'Activo' : 'Inactivo' }}
                                                </span></td>
                                            <td>
                                                <div class="mr-1">
                                                    @if ($colaborador->estado == 1)
                                                        <!-- Botón para activar/desactivar -->
                                                        <button type="button"
                                                            class="btn btn-{{ $colaborador->estado == 1 ? 'danger' : 'success' }}"
                                                            role="button" onclick="confirmAction({{ $colaborador->id }})">
                                                            <i
                                                                class="fas fa-{{ $colaborador->estado == 1 ? 'trash' : 'power' }}"></i>
                                                        </button>
                                                    @endif

                                                </div>
                                                <form id="deleteForm{{ $colaborador->id }}"
                                                    action="{{ route('precios.destroy', ['precios' => $colaborador->id]) }}"
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function confirmAction(colaboradorId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Quieres cambiar el estado de este salario?',
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
