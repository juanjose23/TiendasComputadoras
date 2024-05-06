<div>
    <form wire:submit.prevent="changePassword">
        <div class="mb-3">
            <label for="currentPassword" class="form-label">Contraseña actual</label>
            <input type="password" wire:model="currentPassword" class="form-control @error('currentPassword') is-invalid @enderror" id="currentPassword">
            @error('currentPassword')
                <div class="invalid-feedback">
                    <i class="bi bi-exclamation-triangle"></i> {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="newPassword" class="form-label">Nueva contraseña</label>
            <input type="password" wire:model="newPassword" class="form-control @error('newPassword') is-invalid @enderror" id="newPassword">
            @error('newPassword')
                <div class="invalid-feedback">
                    <i class="bi bi-exclamation-triangle"></i> {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirmar nueva contraseña</label>
            <input type="password" wire:model="confirmPassword" class="form-control @error('confirmPassword') is-invalid @enderror" id="confirmPassword">
            @error('confirmPassword')
                <div class="invalid-feedback">
                    <i class="bi bi-exclamation-triangle"></i> {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
    </form>
    
</div>
