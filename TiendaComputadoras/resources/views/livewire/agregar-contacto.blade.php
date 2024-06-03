<div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form class="row" wire:submit.prevent="save">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nombre" class="form-label">Nombre completo</label>
                <input type="text" wire:model="nombre" class="form-control @error('nombre') is-invalid @enderror"
                    id="nombre">
                @error('nombre')
                    <div class="invalid-feedback">
                        <i class="bi bi-exclamation-triangle"></i> {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="correo" class="form-label">Correo</label>
                <input type="text" wire:model.blur="correo"
                    class="form-control @error('correo') is-invalid @enderror" id="correo">
                @error('correo')
                    <div class="invalid-feedback">
                        <i class="bi bi-exclamation-triangle"></i> {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="telefono" class="form-label">Teléfono o celular</label>
                <input type="text" wire:model.blur="telefono"
                    class="form-control @error('telefono') is-invalid @enderror" id="telefono">
                @error('telefono')
                    <div class="invalid-feedback">
                        <i class="bi bi-exclamation-triangle"></i> {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="cargo" class="form-label">Cargo</label>
                <input type="text" wire:model="cargo" class="form-control @error('cargo') is-invalid @enderror"
                    id="cargo">
                @error('cargo')
                    <div class="invalid-feedback">
                        <i class="bi bi-exclamation-triangle"></i> {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="pais" class="form-label text-dark">País</label>
                <select style="width: 100%" id="pais" name="pais" wire:model="pais"
                    class="form-control buscador @error('pais') is-invalid @enderror">
                    <option value="">Elegir país</option>
                    @foreach ($paises as $pais)
                        <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
                    @endforeach
                </select>
                @error('pais')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="estado" class="form-label text-dark">Estado</label>
                <select style="width: 100%" id="estado" wire:model="estado" name="estado"
                    class="form-control buscador @error('estado') is-invalid @enderror">
                    <option value="">Elegir estado</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
                @error('estado')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-12">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                <button type="button" id="cerrar" class="btn btn-danger mb-2 me-md-2">Cancelar</button>
                <button type="submit" class="btn btn-primary mb-2">Registrar contacto</button>
            </div>
        </div>
    </form>
</div>
