<div>

    <form wire:submit.prevent="changePassword">
        <div class="mb-3">
            @if (session()->has('message'))
            @endif
            @if ($errors->has('newPassword'))
                <script>
                    document.getElementById('newPassword').classList.add('is-invalid');
                </script>
            @endif
            <label for="currentPassword" class="form-label">Contraseña actual</label>
            <input type="password" wire:model="currentPassword"
                class="form-control @error('currentPassword') is-invalid @enderror" id="currentPassword">
            @error('currentPassword')
                <div class="invalid-feedback">
                    <i class="bi bi-exclamation-triangle"></i> {{ $message }}
                </div>
            @enderror
            @if (session()->has('message'))
                <div class="invalid-feedback">
                    <i class="bi bi-exclamation-triangle"></i> {{ session('message') }}
                </div>
            @endif
        </div>
        <div class="mb-3">

            <label for="newPassword" class="form-label">Nueva contraseña</label>
            <input type="password" wire:model="newPassword"
                class="form-control @error('newPassword') is-invalid @enderror" id="newPassword">
            @error('newPassword')
                <div class="invalid-feedback">
                    <i class="bi bi-exclamation-triangle"></i> {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="newPassword_confirmation" class="form-label">Confirmar nueva contraseña</label>
            <input type="password" wire:model="newPassword_confirmation"
                class="form-control @error('newPassword_confirmation') is-invalid @enderror"
                id="newPassword_confirmation">
            @error('newPassword_confirmation')
                <div class="invalid-feedback">
                    <i class="bi bi-exclamation-triangle"></i> {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
    </form>

</div>
