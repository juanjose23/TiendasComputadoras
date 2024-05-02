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
                                        data-id="{{ $producto['id'] }}" data-modelo="{{ $producto['modelo'] }}"
                                        data-codigo="{{ $producto['codigo'] }}" data-color="{{ $producto['color'] }}" data-corte="{{ $producto['corte'] }}" data-talla="{{ $producto['tallas'] }}">
                                        Producto: {{ $producto['nombre'] }} Marca: {{ $producto['marca'] }} Modelo:
                                        {{ $producto['modelo'] }} Color: {{ $producto['color'] }} Corte:
                                        {{ $producto['corte'] }} Talla: {{ $producto['tallas'] }}
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
                        <input type="checkbox" id="terminos" name="terminos" class="form-check-input" value="1">
                        <span class="form-check-label text-dark">
                            ¿Establecer este precio para todas las variantes  del producto?
                        </span>
                    </label>

                </div>
            </div>

            <div class="col-md-12" id="omitir-color" style="display: none;">
                <div class="form-group">
                    <label for="colores-omitir" class="form-label text-dark">¿Qué variantes desea omitir de este
                        precio?</label>
                    <select id="colores-omitir" name="colores-omitir[]" class="form-select buscador is-invalid"
                        multiple="multiple" style="width: 100%">

                    </select>
                    <div class="text-danger ">Todos los productos van a cambiar su precios menos el que sean omitidos</div>
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
        var coloresOmitirSelect = $('#colores-omitir');

        // Mantener los valores seleccionados después de una validación
        var valoresSeleccionados = {!! json_encode(old('colores-omitir', [])) !!};
      
        coloresOmitirSelect.val(valoresSeleccionados).trigger('change');

        // El resto del código para cargar las opciones se mantiene igual
        var productoSelect = $('#producto');
        var coloresOmitirDiv = $('#omitir-color');
        var terminosRadio = $('#terminos');

        productoSelect.on('change', function() {
            $('#terminos').prop('checked', false);
            coloresOmitirDiv.css('display', 'none');
        });

        terminosRadio.on('change', function() {
            if ($(this).is(':checked')) {
                coloresOmitirDiv.css('display', 'block');
                cargarColoresDisponibles(productoSelect.val());
            } else {
                coloresOmitirDiv.css('display', 'none');
            }
        });

        function cargarColoresDisponibles(productoId) {
            coloresOmitirSelect.empty();

            var productoCodigo = obtenerCodigoProducto(productoId);
            var opcionesProductos = productoSelect.find('option');

            opcionesProductos.each(function() {
                var codigo = $(this).data('codigo');
                var color = $(this).data('color');
                var modelo = $(this).data('modelo');
                var corte= $(this).data('corte');
                var talla=$(this).data('talla');
                var id = $(this).data('id');
                if (codigo === productoCodigo) {
                    var option = $('<option></option>').val(id).text('Color: '+' '+ color + ' ' +
                        'Modelo de producto ' + modelo+ ' ' + 'Corte: '+' '+ corte +' '+ 'Talla:'+' ' + talla);
                    coloresOmitirSelect.append(option);
                }
            });
        }

        function obtenerCodigoProducto(productoId) {
            var selectedOption = productoSelect.find('option[value="' + productoId + '"]');
            return selectedOption ? selectedOption.data('codigo') : null;
        }
    });
</script>
