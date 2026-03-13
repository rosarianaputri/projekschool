<div class="mb-2">
    <h5 class="fw-semibold"><i class="feather-lock me-2 text-primary"></i>Update Password</h5>
    <p class="text-muted small">Ensure your account is using a long, random password to stay secure.</p>
</div>

<form method="post" action="{{ route('password.update') }}">
    @csrf
    @method('put')

    @if (session('status') === 'password-updated')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="feather-check-circle me-2"></i> Password updated successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="mb-3">
        <label for="update_password_current_password" class="form-label fw-medium">Current Password</label>
        <input id="update_password_current_password" name="current_password" type="password"
               class="form-control @if($errors->updatePassword->get('current_password')) is-invalid @endif"
               autocomplete="current-password">
        @foreach($errors->updatePassword->get('current_password') as $error)
            <div class="invalid-feedback">{{ $error }}</div>
        @endforeach
    </div>

    <div class="mb-3">
        <label for="update_password_password" class="form-label fw-medium">New Password</label>
        <input id="update_password_password" name="password" type="password"
               class="form-control @if($errors->updatePassword->get('password')) is-invalid @endif"
               autocomplete="new-password">
        @foreach($errors->updatePassword->get('password') as $error)
            <div class="invalid-feedback">{{ $error }}</div>
        @endforeach
    </div>

    <div class="mb-3">
        <label for="update_password_password_confirmation" class="form-label fw-medium">Confirm Password</label>
        <input id="update_password_password_confirmation" name="password_confirmation" type="password"
               class="form-control @if($errors->updatePassword->get('password_confirmation')) is-invalid @endif"
               autocomplete="new-password">
        @foreach($errors->updatePassword->get('password_confirmation') as $error)
            <div class="invalid-feedback">{{ $error }}</div>
        @endforeach
    </div>

    <button type="submit" class="btn btn-primary">
        <i class="feather-save me-1"></i> Save
    </button>
</form>
