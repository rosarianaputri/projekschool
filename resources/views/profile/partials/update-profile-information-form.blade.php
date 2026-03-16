<div class="mb-2">
    <h5 class="fw-semibold"><i class="feather-user me-2 text-primary"></i>Profile Information</h5>
    <p class="text-muted small">Update your account's profile information and email address.</p>
</div>

<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}">
    @csrf
    @method('patch')

    @if (session('status') === 'profile-updated')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="feather-check-circle me-2"></i> Profile updated successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="mb-3">
        <label for="name" class="form-label fw-medium">Name</label>
        <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label fw-medium">Email</label>
        <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email', $user->email) }}" required autocomplete="username">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="alert alert-warning mt-2 py-2">
                <small>Your email address is unverified.
                    <button form="send-verification" class="btn btn-link btn-sm p-0 align-baseline">
                        Click here to re-send the verification email.
                    </button>
                </small>
                @if (session('status') === 'verification-link-sent')
                    <div class="text-success small mt-1">A new verification link has been sent to your email address.</div>
                @endif
            </div>
        @endif
    </div>

    <button type="submit" class="btn btn-primary">
        <i class="feather-save me-1"></i> Save
    </button>
</form>
