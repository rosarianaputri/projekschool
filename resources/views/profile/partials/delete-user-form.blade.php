<div class="mb-2">
    <h5 class="fw-semibold text-danger"><i class="feather-trash-2 me-2"></i>Delete Account</h5>
    <p class="text-muted small">Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>
</div>

<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
    <i class="feather-trash-2 me-1"></i> Delete Account
</button>

<!-- Confirm Delete Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true" @if($errors->userDeletion->isNotEmpty()) data-bs-show="true" @endif>
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="confirmDeleteModalLabel">
                        <i class="feather-alert-triangle me-2"></i>Delete Account
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p class="text-muted">Are you sure you want to delete your account? This action cannot be undone. Please enter your password to confirm.</p>

                    <div class="mb-3">
                        <label for="delete_password" class="form-label fw-medium">Password</label>
                        <input id="delete_password" name="password" type="password"
                               class="form-control @if($errors->userDeletion->get('password')) is-invalid @endif"
                               placeholder="Enter your password to confirm">
                        @foreach($errors->userDeletion->get('password') as $error)
                            <div class="invalid-feedback">{{ $error }}</div>
                        @endforeach
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="feather-trash-2 me-1"></i> Yes, Delete Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@if($errors->userDeletion->isNotEmpty())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
        modal.show();
    });
</script>
@endif
