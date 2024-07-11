@extends('layout.layout')
@section('title', 'Productos')
@section('submodulo', 'Subir imagenes')
@section('content')
    <form action="{{ route('productos.guardarmultimedia') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">

            <div class="col-md-4">
                <div class="form-group">
                    <label for="producto" class="form-label text-dark">producto</label>
                    <input type="text" name="nombre" class="form-control" value={{ $productoL->nombre }} disabled>
                    <input type="text" name="" class="form-control" value='{{ $productoL->id }}' hidden>
                    @error('producto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="producto" class="form-label text-dark">Marca</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $productoL->modelos->marcas->nombre }}" disabled>
                
                    @error('producto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="producto" class="form-label text-dark">Modelo</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $productoL->modelos->nombre }}" disabled>
                
                    @error('producto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="producto" class="form-label text-dark">Productos</label>
                    <select id="producto" name="producto"
                        class="form-select buscador @error('producto') is-invalid @enderror"
                        style="width: 100%">
                        <option selected disabled>Elegir Productos</option>
                        @foreach ($productos as $categorias => $subcategoria)
                            <optgroup label="{{ $categorias }}">
                                @foreach ($subcategoria as $productos => $producto)
                            <optgroup label="{{ $productos }}">
                                @foreach ($producto as $producto)
                                    <option value="{{ $producto['id'] }}"
                                        {{ old('producto') == $producto['id'] ? 'selected' : '' }}
                                        data-id="{{ $producto['id'] }}" data-modelo="{{ $producto['modelo'] }}"
                                        data-codigo="{{ $producto['codigo'] }}"
                                        data-nombre="{{ $producto['nombre'] }}"
                                        data-color="{{ $producto['color'] }}"
                                        data-corte="{{ $producto['corte'] }}"
                                        data-talla="{{ $producto['tallas'] }}"
                                        data-marca="{{ $producto['marca'] }}">

                                        Producto: {{ $producto['nombre'] }} Marca: {{ $producto['marca'] }}
                                        Modelo:
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


            <div class="col-md-12">
                <div class="form-group">
                    <label for="foto" class="form-label text-dark">Logo:</label>
                    <input type="file" id="foto" name="foto"
                        class="form-control @error('foto') is-invalid @enderror" value="{{ old('foto') }}"  onchange="previewImage(event)" required>
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <label for="foto" class="form-label text-dark">previewImage:</label>
                <div id="imagePreview" class="mt-2"></div>
            </div>
          


            <div class="col-md-12">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                    <a href="{{ route('productos.show', ['productos' => $productoL->id ]) }}"
                        class="btn btn-danger mb-2 me-md-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary mb-2">Registrar</button>
                </div>

            </div>
        </div>
    </form>

@endsection
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('imagePreview');
            output.innerHTML = '<img src="' + reader.result + '" class="img-thumbnail" style="max-width: 500px;">';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

