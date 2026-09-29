@extends('layouts.dinas')

@section('title', 'Manajemen Pengguna - Dinas Kehutanan Provinsi')

@section('dashboard-content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="fas fa-users-cog me-2"></i>Manajemen Pengguna
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">

        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <i class="fas fa-user-plus me-1"></i>Tambah Pengguna
        </a>
    </div>
</div>

<!-- Tabel Pengguna -->
<div class="executive-card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-executive">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Peran</th>
                        <th>Wilayah</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->email }}</td>
                            <td><span class="badge bg-info">{{ $user->role }}</span></td>
                            <td>{{ $user->region?->name ?? '-' }}</td>
                            <td>
                                @if($user->approval_status === 'Pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($user->approval_status === 'Approved')
                                    <span class="badge bg-success">Approved</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="#editUserModal{{ $user->user_id }}" class="btn btn-outline-secondary" title="Edit" data-bs-toggle="modal">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('dinas.user-management.delete', $user->user_id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>

                                <!-- Modal Edit -->
                                <div class="modal fade" id="editUserModal{{ $user->user_id }}" tabindex="-1" aria-labelledby="editUserLabel{{ $user->user_id }}" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <form method="POST" action="{{ route('dinas.user-management.update', $user->user_id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editUserLabel{{ $user->user_id }}">Edit Pengguna</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Password (opsional)</label>
                                                    <input type="password" name="password" class="form-control" placeholder="Biarkan kosong jika tidak diubah">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Peran</label>
                                                    <select name="role" class="form-select" required>
                                                        <option value="CDK" {{ $user->role === 'CDK' ? 'selected' : '' }}>CDK</option>
                                                        <option value="DINAS_PROVINSI" {{ $user->role === 'DINAS_PROVINSI' ? 'selected' : '' }}>Dinas Provinsi</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Wilayah</label>
                                                    <select name="region_id" class="form-select" required>
                                                        @foreach ($regions as $region)
                                                            <option value="{{ $region->region_id }}" {{ $region->region_id == $user->region_id ? 'selected' : '' }}>{{ $region->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Status Persetujuan</label>
                                                    <select name="approval_status" class="form-select" required>
                                                        <option value="Pending" {{ $user->approval_status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="Approved" {{ $user->approval_status === 'Approved' ? 'selected' : '' }}>Approved</option>
                                                        <option value="Rejected" {{ $user->approval_status === 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Perbarui</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            </div>
                                        </div>
                                    </form>
                                  </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Tidak ada pengguna</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $users->links() }}
        </div>
    </div>
</div>

<!-- Modal Tambah Pengguna -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('dinas.user-management.create') }}">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserLabel">Tambah Pengguna Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required minlength="8">
                </div>
                <div class="mb-3">
                    <label class="form-label">Peran</label>
                    <select name="role" class="form-select" required>
                        <option value="CDK">CDK</option>
                        <option value="DINAS_PROVINSI">Dinas Provinsi</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Wilayah</label>
                    <select name="region_id" class="form-select" required>
                        @foreach ($regions as $region)
                            <option value="{{ $region->region_id }}">{{ $region->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
    // Smart Modal Backdrop Cleanup - Only cleanup when no modals are active
    function destroyAllModalBackdrops() {
        const activeModals = document.querySelectorAll('.modal.show');
        if (activeModals.length === 0) {
            const backdrops = document.querySelectorAll('.modal-backdrop, [class*="modal-backdrop"]');
            backdrops.forEach(backdrop => {
                backdrop.remove();
            });
            document.body.classList.remove('modal-open');
            document.body.style.removeProperty('padding-right');
            document.body.style.removeProperty('overflow');
        }
    }

    // MutationObserver to detect and remove backdrop elements in real-time
    const backdropObserver = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            mutation.addedNodes.forEach(function(node) {
                if (node.nodeType === 1) {
                    // Check if the added node is a backdrop
                    if (node.classList && (node.classList.contains('modal-backdrop') || 
                        node.className.includes('modal-backdrop'))) {
                        const activeModals = document.querySelectorAll('.modal.show');
                        if (activeModals.length === 0) {
                            node.remove();
                        }
                    }
                    // Check for backdrop in child nodes
                    const childBackdrops = node.querySelectorAll && node.querySelectorAll('.modal-backdrop, [class*="modal-backdrop"]');
                    if (childBackdrops) {
                        const activeModals = document.querySelectorAll('.modal.show');
                        if (activeModals.length === 0) {
                            childBackdrops.forEach(backdrop => backdrop.remove());
                        }
                    }
                }
            });
        });
    });

    // Start observing
    backdropObserver.observe(document.body, {
        childList: true,
        subtree: true
    });

    // Override Bootstrap Modal to prevent backdrop creation
    if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
        const originalShow = bootstrap.Modal.prototype.show;
        bootstrap.Modal.prototype.show = function() {
            this._config.backdrop = false;
            return originalShow.call(this);
        };
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Clean up any existing backdrops on page load
        destroyAllModalBackdrops();

        // Enhanced Add User Modal
        function showAddUserModal() {
            destroyAllModalBackdrops();
            const modal = new bootstrap.Modal(document.getElementById('addUserModal'), {
                backdrop: false,
                keyboard: true,
                focus: true
            });
            modal.show();
            
            // Ensure modal is visible and clickable
            setTimeout(function() {
                const modalElement = document.getElementById('addUserModal');
                modalElement.style.display = 'block';
                modalElement.classList.add('show');
                modalElement.setAttribute('aria-modal', 'true');
                modalElement.removeAttribute('aria-hidden');
                destroyAllModalBackdrops();
            }, 100);
        }

        // Enhanced Edit User Modal
        function showEditUserModal(modalId) {
            destroyAllModalBackdrops();
            const modal = new bootstrap.Modal(document.getElementById(modalId), {
                backdrop: false,
                keyboard: true,
                focus: true
            });
            modal.show();
            
            // Ensure modal is visible and clickable
            setTimeout(function() {
                const modalElement = document.getElementById(modalId);
                modalElement.style.display = 'block';
                modalElement.classList.add('show');
                modalElement.setAttribute('aria-modal', 'true');
                modalElement.removeAttribute('aria-hidden');
                destroyAllModalBackdrops();
            }, 100);
        }

        // Override click handlers for add user button
        const addUserBtn = document.querySelector('[data-bs-target="#addUserModal"]');
        if (addUserBtn) {
            addUserBtn.removeAttribute('data-bs-toggle');
            addUserBtn.removeAttribute('data-bs-target');
            addUserBtn.addEventListener('click', function(e) {
                e.preventDefault();
                showAddUserModal();
            });
        }

        // Override click handlers for edit user buttons
        const editUserBtns = document.querySelectorAll('[href^="#editUserModal"]');
        editUserBtns.forEach(function(btn) {
            btn.removeAttribute('data-bs-toggle');
            const modalId = btn.getAttribute('href').substring(1);
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                showEditUserModal(modalId);
            });
        });

        // Handle add user form submission
        const addUserForm = document.querySelector('#addUserModal form');
        if (addUserForm) {
            addUserForm.addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Menyimpan...';
                submitBtn.disabled = true;
                
                // Hide modal and cleanup
                setTimeout(function() {
                    const modal = bootstrap.Modal.getInstance(document.getElementById('addUserModal'));
                    if (modal) {
                        modal.hide();
                    }
                    destroyAllModalBackdrops();
                }, 100);
            });
        }
        
        // Handle edit user forms submission
        const editUserForms = document.querySelectorAll('[id^="editUserModal"] form');
        editUserForms.forEach(function(form) {
            form.addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Memperbarui...';
                submitBtn.disabled = true;
                
                // Hide modal and cleanup
                setTimeout(function() {
                    const modalId = form.closest('.modal').id;
                    const modal = bootstrap.Modal.getInstance(document.getElementById(modalId));
                    if (modal) {
                        modal.hide();
                    }
                    destroyAllModalBackdrops();
                }, 100);
            });
        });

        // Periodic cleanup every 500ms
        setInterval(destroyAllModalBackdrops, 500);

        // Cleanup on window events
        window.addEventListener('resize', destroyAllModalBackdrops);
        window.addEventListener('scroll', destroyAllModalBackdrops);
        document.addEventListener('click', function(e) {
            // If clicking outside modal, cleanup backdrops
            if (!e.target.closest('.modal-content') && !e.target.closest('[data-bs-toggle="modal"]')) {
                setTimeout(destroyAllModalBackdrops, 50);
            }
        });
    });
</script>
@endpush