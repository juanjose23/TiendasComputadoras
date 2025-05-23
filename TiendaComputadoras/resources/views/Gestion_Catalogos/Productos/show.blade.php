@extends('layout.layout')

@section('title', 'Productos')
@section('submodulo', 'Detalles de productos')
@section('content')
    <div class="tab">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" href="#icon-tab-1" data-bs-toggle="tab" role="tab" aria-selected="true">
                    <i class="bi bi-file-earmark-text"></i> <!-- Icono de Bootstrap -->
                    Datos generales
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" href="#icon-tab-2" data-bs-toggle="tab" role="tab" aria-selected="false"
                    tabindex="-1">
                    <i class="align-middle me-2" data-feather="list" style="color:brown;"></i>
                    Variantes de detalles
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" href="#icon-tab-3" data-bs-toggle="tab" role="tab" aria-selected="false"
                    tabindex="-1">
                    <i class="bi bi-images"></i> <!-- Icono de Bootstrap -->
                    Administración de imágenes
                </a>
            </li>

        </ul>
        <div class="tab-content">
            <div class="tab-pane active show" id="icon-tab-1" role="tabpanel">
                <h4 class="tab-title">Datos generales del producto {{ $productos->nombre }}</h4>
                <div class="col-xl-12">
                    <div class="">
                        <div class="card-header">
                            <div class="card-actions float-end">
                                <div class="dropdown position-relative">
                                    <a href="{{ route('productos.index') }}" class=" btn btn-danger">
                                        <i class="bi bi-house"></i> volver al inicio
                                    </a>


                                </div>
                            </div>
                            <h5 class="card-title mb-0 text-black text-center">Producto {{ $productos->nombre }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-0">

                                <div class="col-sm-9 col-xl-12 col-xxl-9">
                                    <strong>Descripcion</strong>
                                    <p>{{ $productos->descripcion }}</p>
                                </div>
                            </div>

                            <table class="table table-sm mt-2 mb-4">
                                <tbody>
                                    <tr>
                                        <th>Codigo:</th>
                                        <td>{{ $productos->codigo }}</td>
                                    </tr>
                                    <tr>
                                        <th>Categoría:</th>
                                        <td>{{ $productos->subcategorias->categorias->nombre }}</td>
                                    </tr>
                                    <tr>
                                        <th>Subcategoría:</th>
                                        <td>{{ $productos->subcategorias->nombre }}</td>
                                    </tr>
                                    <tr>
                                        <th>Marca:</th>
                                        <td>{{ $productos->modelos->marcas->nombre }}</td>
                                    </tr>
                                    <tr>
                                        <th>Modelo:</th>
                                        <td>{{ $productos->modelos->nombre }}</td>
                                    </tr>
                                    <tr>
                                        <th>Estado:</th>
                                        <td><span
                                                class="badge rounded-pill {{ $productos->estado == 1 ? 'bg-success' : 'bg-danger' }}">
                                                {{ $productos->estado == 1 ? 'Activo' : 'Inactivo' }}
                                            </span></td>
                                    </tr>
                                    <tr>
                                        <th>Fecha de lanzamiento:</th>
                                        <td>{{ $productos->fecha_lanzamiento }}</td>
                                    </tr>
                                    <tr>
                                        <th>Fecha de registro:</th>
                                        <td>{{ $productos->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th>Fecha de actualización:</th>
                                        <td>{{ $productos->updated_at }}</td>
                                    </tr>
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="icon-tab-2" role="tabpanel">
                <h4 class="tab-title"> <i class="align-middle me-2" data-feather="list" style="color:brown;"></i>
                    Detalles de los Variantes</h4>
                <div class="">
                    <div class="card-header">
                        <div class="card-actions float-end">

                            <!-- HTML -->
                            <div class="btn-group btn-group-md">
                                <div class="mb-3 me-2">
                                    <a href="{{ route('productos.index') }}" class="btn btn-danger">
                                        <i class="fas fa-house"></i> Volver al inicio
                                    </a>
                                </div>
                                <div class="mb-2">
                                    <a href="{{ route('productos.agregardetalles', ['id' => $productos->id]) }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Crear nuevos detalles
                                    </a>
                                </div>
                            </div>

                        </div>

                        <h5 class="card-title mb-0 text-black text-center">Producto {{ $productos->nombre }}</h5>
                    </div>
                    <div class="card-body">
                        <livewire:detallesproductos />

                    </div>
                </div>
            </div>


            <div class="tab-pane" id="icon-tab-3" role="tabpanel">
                <h4 class="tab-title"><i class="bi bi-images" style="color: brown;"></i> Galería del producto</h4>

                <div class="">
                    <div class="card-header">
                        <div class="card-actions float-end">

                            <a href="{{ route('productos.index') }}" class=" btn btn-danger">
                                <i class="fas fa-home"></i> volver al inicio
                            </a>
                            @can('update', App\Models\Productos::class)
                                <a href="{{ route('productos.multimedia', ['id' => $productos->id]) }}"
                                    class=" btn btn-primary">
                                    <i class="fas fa-plus"></i> Agregar Imagen
                                </a>
                            @endcan

                        </div>
                        <h5 class="card-title mb-0 text-black text-center">Producto {{ $productos->nombre }}</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm mt-2 mb-4">
                            <thead>
                                <tr>
                                    <th>Imagen</th>

                                    <th>Fecha de registro</th>
                                    <th>Fecha de actualización</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($imagenes as $imagenproducto)
                                    <tr>
                                        <td>
                                            <img src="{{ $imagenproducto->imagenes->url }}" alt="Imagen" class="img-fluid"
                                                width="100px">
                                        </td>




                                        <td>{{ $imagenproducto->created_at }}</td>
                                        <td>{{ $imagenproducto->updated_at }}</td>
                                        <td>
                                            @can('delete', App\Models\Productos::class)
                                                <button type="button" class="btn btn-danger btn-sm" role="button"
                                                    onclick="confirmActionimg({{ $imagenproducto->imagenes->id }})">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                <form id="deleteFormimg{{ $imagenproducto->imagenes->id }}"
                                                    action="{{ route('productos.destroyimg', ['id' => $imagenproducto->imagenes->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="text" name="id" value={{ $imagenproducto->imagenes->id }}
                                                        hidden>
                                                    <!-- Este botón no es visible, pero se utilizará para activar el SweetAlert -->
                                                    <button id="submitBtn{{ $imagenproducto->imagenes->id }}" type="submit"
                                                        style="display: none;"></button>
                                                </form>
                                            @endcan
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
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Inicializar el dropdown
        var dropdown = new bootstrap.Dropdown(document.getElementById('infoDropdown'));

        // Agregar evento para cerrar el dropdown cuando se haga clic fuera de él
        document.addEventListener("click", function(event) {
            var dropdownToggle = document.getElementById('infoDropdown');
            var dropdownMenu = document.querySelector('.dropdown-menu');

            if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdown.hide();
            }
        });
    });
</script>
<script>
    function confirmAction(ColorId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Quieres cambiar el estado de este detalle?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, cambiar estado'
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById('deleteForm' + ColorId);

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

    function confirmActionimg(imgId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Quieres eliminar este archivo?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, cambiar eliminar'
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById('deleteFormimg' + imgId);

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
