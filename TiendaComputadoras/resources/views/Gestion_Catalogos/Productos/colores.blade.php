@extends('layout.layout')
@section('title', 'Colores')
@section('submodulo', 'Registrar variante de Colores')
@section('content')
    <form action="{{ route('coloresproductos.store') }}" method="POST">
        @csrf
        <div class="row">

            <div class="col-md-4">
                <div class="form-group">
                    <label for="producto" class="form-label text-dark">producto</label>
                    <input type="text" name="nombre" class="form-control" value='{{ $producto->productos->nombre }}'
                        disabled>
                    <input type="text" name="producto" class="form-control" value='{{ $producto->productos->id }}'
                        hidden>
                    <input type="text" name="detalle" value="{{$producto->id}}" hidden>
                    @error('producto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="color" class="form-label text-dark">color</label>
                    <select id="color" name="color" class="buscador form-select @error('color') is-invalid @enderror">
                        <option selected disabled>Elegir color</option>
                        @foreach ($colores as $color)
                            <option value="{{ $color->id }}" {{ old('color') == $color->id ? 'selected' : '' }}>
                                {{ $color->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('color')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="estado" class="form-label text-dark">Estado</label>
                    <select id="estado" name="estado" class="form-select @error('estado') is-invalid @enderror"
                        required>
                        <option selected disabled>Elegir estado</option>
                        <option value="1" {{ old('estado') == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="col-md-12">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                    <a href="{{ route('productos.show', ['productos' => $producto->productos->id]) }}"
                        class="btn btn-danger mb-2 me-md-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary mb-2">Registrar</button>
                </div>

            </div>
        </div>
    </form>


    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0 text-black text-center">Lista de cortes del Producto
                    {{ $producto->productos->nombre }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm mt-2 mb-4">
                    <thead>
                        <tr>

                            <th>Corte</th>
                            <th>Descripcion</th>
                            <th>Muestra</th>
                            <th>Estado</th>
                            <th>Fecha de registro</th>
                            <th>Fecha de actualización</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listacolores as $color)
                            <tr>
                                <td>{{ $color->colores->nombre }}</td>
                                <td>{{ $color->colores->codigo }}</td>
                               
                                <td>
                                    <span class="badge rounded-pill ">
                                        <div
                                            style="width: 20px; height: 20px; border-radius: 50%; background-color:{{ $color->colores->codigo }}">
                                        </div>
        
                                    </span>
                                </td>


                                <td>
                                    <span
                                        class="badge rounded-pill {{ $color->estado == 1 ? 'bg-success' : 'bg-danger' }}">
                                        {{ $color->estado == 1 ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td>{{ $color->created_at }}</td>
                                <td>{{ $color->updated_at }}</td>
                                <td>
                                    @can('delete', App\Models\Productos::class)
                                        <button type="button"
                                            class="btn btn-{{ $color->estado == 1 ? 'danger' : 'success' }} btn-block"
                                            role="button" onclick="confirmAction({{ $color->id }})">
                                            <i class="fas fa-{{ $color->estado == 1 ? 'trash-alt' : 'toggle-on' }}"></i>

                                        </button>
                                        <form id="deleteForm{{ $color->id }}"
                                            action="{{ route('coloresproductos.destroy', ['coloresproductos' => $color->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="text" name="id" value={{ $color->id }} hidden>
                                            <!-- Este botón no es visible, pero se utilizará para activar el SweetAlert -->
                                            <button id="submitBtn{{ $color->id }}" type="submit"
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
@endsection

<script>
    function confirmAction(ColorId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Quieres cambiar el estado de este color,  se dara de baja al detalle correspondiente?',
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
</script>
