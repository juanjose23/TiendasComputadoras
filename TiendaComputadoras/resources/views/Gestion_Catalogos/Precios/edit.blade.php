@extends('layout.layout')
@section('title', 'Productos')
@section('submodulo', 'Actualizar Precios')
@section('content')
    <form action="{{ route('precios.update', $precio->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <input type="text"  id="producto"name="producto" value="{{ $precio->productosdetalles_id }}" hidden>
            <div class="col-md-6 col-lg-16">
                <div class="form-group">
                    <label for="Marca" class="form-label text-dark">Marca y modelos:</label>
                    <input type="text" id="Marca" name="marcas" class="form-control"
                        value="Marca:{{ $precio->productosdetalles->productos->modelos->marcas->nombre }} Modelo:{{ $precio->productosdetalles->productos->modelos->nombre }}"
                        disabled>
                    @error('producto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 col-lg-16">
                <div class="form-group">
                    <label for="categorias" class="form-label text-dark">Categoría y subcategoria:</label>
                    <input type="text" id="categorias" name="categorias" class="form-control"
                        value="Categoría: {{ $precio->productosdetalles->productos->subcategorias->categorias->nombre }} Subcategoria: {{ $precio->productosdetalles->productos->subcategorias->nombre }}"
                        disabled>
                    @error('producto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 col-lg-16">
                <div class="form-group">
                    <label for="nombre" class="form-label text-dark">Productos:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control"
                        value="{{ $precio->productosdetalles->productos->nombre }}" disabled>
                    @error('producto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="precio" class="form-label text-dark">Precio:</label>
                    <input type="number" id="precio" name="precio" placeholder="Escribe el precio"
                        class="form-control @error('precio') is-invalid @enderror"
                        value="{{ old('precio', $precio->precio) }}">
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
                        <option value="1" {{ old('estado', $precio->estado) == '1' ? 'selected' : '' }}>Activo
                        </option>
                        <option value="0" {{ old('estado', $precio->estado) == '2' ? 'selected' : '' }}>Inactivo
                        </option>
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
                            ¿Establecer este precio para todas las variantes de colores del producto?
                        </span>
                    </label>

                </div>
            </div>

            <div class="col-md-12" id="omitir-color" style="display: none;">
                <div class="form-group">
                    <label for="colores-omitir" class="form-label text-dark">¿Qué colores desea omitir de este
                        precio?</label>
                    <select id="colores-omitir" name="colores-omitir[]" class="form-select buscador is-invalid"
                        multiple="multiple" style="width: 100%">
                        @foreach ($colores as $color)
                            <option value="{{ $color->id }}">Producto: {{ $color->productos->nombre }} Marca: {{ $color->productos->modelos->marcas->nombre }} Modelo: {{ $color->productos->modelos->nombre }}  Color: {{ $color->coloresproductos->colores->nombre }} Talla: {{ $color->tallasproductos->tallas->nombre }} Cortes: {{ $color->cortesproductos->cortes->nombre }}</option>
                        @endforeach
                    </select>
                    <div class="text-warning ">Todos los productos van a cambiar su precios menos el que sean omitidos</div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                    <a href="{{ route('precios.index') }}" class="btn btn-danger mb-2 me-md-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary mb-2">Actualizar</button>
                </div>

            </div>
        </div>
    </form>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var coloresOmitirSelect = $('#colores-omitir');


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
    });
</script>
