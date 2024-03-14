@extends('layout.layout')
@section('title', 'Productos')
@section('submodulo', 'Registrar Precios')
@section('content')
    <form action="{{ route('precios.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="form-group">
                    <label for="producto" class="form-label text-dark">Productos</label>
                    <select id="producto" name="producto"
                        class="form-select buscador @error('producto') is-invalid @enderror" style="width: 100%">
                        <option selected disabled>Elegir Productos</option>
                        @foreach ($productos as $categorias => $subcategoria)
                            <optgroup label="{{ $categorias }}">
                                @foreach ($subcategoria as $productos => $producto)
                            <optgroup label="{{ $productos }}">
                                @foreach ($producto as $producto)
                                    <option value="{{ $producto['id'] }}"
                                        {{ old('producto') == $producto['id'] ? 'selected' : '' }}
                                        data-modelo="{{ $producto['modelo'] }}" data-codigo="{{ $producto['codigo'] }}"
                                        data-color="{{ $producto['color'] }}">
                                        Producto: {{ $producto['nombre'] }} Marca: {{ $producto['marca'] }} Modelo:
                                        {{ $producto['modelo'] }} Color: {{ $producto['color'] }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                        </optgroup>
                        @endforeach
                    </select>
                    @error('producto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="precio" class="form-label text-dark">Precio:</label>
                    <input type="number" id="precio" name="precio" placeholder="Escribe el precio"
                        class="form-control @error('precio') is-invalid @enderror" value="{{ old('precio') }}">
                    @error('precio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="estado" class="form-label text-dark">Estado</label>
                    <select id="estado" name="estado" class="form-select @error('estado') is-invalid @enderror">
                        <option selected disabled>Elegir estado</option>
                        <option value="1" {{ old('estado') == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group text-center">
                    <div class="mt-4"></div>
                    <label for="terminos" class="form-check text-dark">
                        <input type="checkbox" id="terminos" name="terminos" class="form-check-input" value="1"
                            {{ old('terminos') == '1' ? 'checked' : '' }}>
                        <span class="form-check-label text-dark">
                            ¿Establecer este precio para todas las variantes de colores del producto?
                        </span>
                    </label>
                    @error('terminos')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6" id="omitir-color" style="display: none;">
                <div class="form-group">
                    <label for="colores-omitir"  class="form-label text-dark">¿Qué colores desea omitir de este precio?</label>
                    <select id="colores-omitir" name="colores-omitir[]"  class="form-select buscador">

                    </select>
                </div>
            </div>

            <div class="col-md-12">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                    <a href="{{ route('precios.index') }}" class="btn btn-danger mb-2 me-md-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary mb-2">Registrar</button>
                </div>

            </div>
        </div>
    </form>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var productoSelect = document.getElementById('producto');
        var coloresOmitirDiv = document.getElementById('omitir-color');
        var terminosRadio = document.getElementById('terminos');

        productoSelect.addEventListener('change', function() {
            // Reiniciar el estado del checkbox cuando se cambia la opción del select
            terminosRadio.checked = false;

        });

        terminosRadio.addEventListener('change', function() {
            if (this.checked) {
                coloresOmitirDiv.style.display = 'block';
                cargarColoresDisponibles(productoSelect.value);
            } else {
                coloresOmitirDiv.style.display = 'none';
            }
        });

        function cargarColoresDisponibles(productoId) {
            var coloresOmitirSelect = document.getElementById('colores-omitir');
            coloresOmitirSelect.innerHTML = '';

            var productoCodigo = obtenerCodigoProducto(productoId);
            var opcionesProductos = productoSelect.options;

            for (var i = 0; i < opcionesProductos.length; i++) {
                var opcion = opcionesProductos[i];
                var codigo = opcion.getAttribute('data-codigo');
                var color = opcion.getAttribute('data-color');
                var modelo = opcion.getAttribute('data-modelo');
                if (codigo === productoCodigo) {
                    var option = document.createElement('option');
                    option.value = color + ' ' + 'Modelo de producto ' + modelo;
                    option.textContent = color + ' ' + 'Modelo de producto ' + modelo;
                    coloresOmitirSelect.appendChild(option);
                }
            }
        }

        function obtenerCodigoProducto(productoId) {
            var selectedOption = productoSelect.querySelector('option[value="' + productoId + '"]');
            return selectedOption ? selectedOption.getAttribute('data-codigo') : null;
        }
    });
</script>
