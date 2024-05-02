@extends('layout.layout')
@section('title', 'Cortes')
@section('submodulo', 'Registrar variante de cortes')
@section('content')
    <form action="{{ route('productos.guardarcorte') }}" method="POST">
        @csrf
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <div class="row">

            <div class="col-md-4">
                <div class="form-group">
                    <label for="producto" class="form-label text-dark">producto</label>
                    <input type="text" name="nombre" class="form-control" value={{ $producto->productos->nombre }}
                        disabled>
                    <input type="text" name="producto" class="form-control" value='{{ $producto->productos->id }}'
                        hidden>
                    <input type="text" name="detalle" value="{{ $producto->id }}" hidden>
                    @error('producto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="color" class="form-label text-dark">Cortes:</label>
                    <select id="cortes" name="cortes"
                        class="buscador form-select @error('cortes') is-invalid @enderror" style="width: 100%; height: 100%">
                        <option selected disabled>Elegir cortes</option>
                        @foreach ($corte as $color)
                            <option value="{{ $color->id }}" {{ old('cortes') == $color->id ? 'selected' : '' }}>
                                {{ $color->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('cortes')
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
                            <th>Estado</th>
                            <th>Fecha de registro</th>
                            <th>Fecha de actualización</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cortes as $corte)
                            <tr>
                                <td>{{ $corte->cortes->nombre }}</td>
                                <td>{{ $corte->cortes->descripcion }}</td>



                                <td>
                                    <span
                                        class="badge rounded-pill {{ $corte->estado == 1 ? 'bg-success' : 'bg-danger' }}">
                                        {{ $corte->estado == 1 ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td>{{ $corte->created_at }}</td>
                                <td>{{ $corte->updated_at }}</td>
                                <td>
                                    @can('delete', App\Models\Productos::class)
                                        <button type="button"
                                            class="btn btn-{{ $corte->estado == 1 ? 'danger' : 'success' }}"
                                            role="button" onclick="confirmAction({{ $corte->id }})">
                                            <i class="fas fa-{{ $corte->estado == 1 ? 'trash-alt' : 'toggle-on' }}"></i>

                                        </button>
                                        <form id="deleteForm{{ $corte->id }}"
                                            action="{{ route('productos.destroycortes', ['id' => $corte->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="text" name="id" value={{ $corte->id }} hidden>
                                            <!-- Este botón no es visible, pero se utilizará para activar el SweetAlert -->
                                            <button id="submitBtn{{ $corte->id }}" type="submit"
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
    function confirmAction(CorteId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Quieres cambiar el estado de este corte,  se dara de baja al detalle correspondiente?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, cambiar estado'
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById('deleteForm' + CorteId);

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
