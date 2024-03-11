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
                    <input type="text" name="nombre" class="form-control" value={{ $producto->nombre }} disabled>
                    <input type="text" name="producto" class="form-control" value='{{ $producto->id }}' hidden>
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
