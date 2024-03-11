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
                    <input type="text" name="nombre" class="form-control" value={{ $producto->nombre }} disabled>
                    <input type="text" name="producto" class="form-control" value='{{ $producto->id }}' hidden>
                    @error('producto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="producto" class="form-label text-dark">Marca</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $producto->modelos->marcas->nombre }}" disabled>
                
                    @error('producto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="producto" class="form-label text-dark">Modelo</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $producto->modelos->nombre }}" disabled>
                
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
                    <a href="{{ route('productos.show', ['productos' => $producto->id]) }}"
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

