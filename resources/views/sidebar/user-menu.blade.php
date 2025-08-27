<div class="d-flex align-items-center mb-2">
    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}&color=ffffff&background=0d6efd"
         alt="User Avatar" class="user-avatar rounded-circle me-2">
    <div class="flex-grow-1">
        <div class="text-white small fw-semibold">{{ auth()->user()->name ?? 'Guest User' }}</div>
        <div class="text-muted small">{{ auth()->user()->email ?? 'guest@example.com' }}</div>
    </div>
</div>
<div class="dropdown">
    <button class="btn btn-outline-light btn-sm dropdown-toggle w-100" type="button"
            data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-person-circle me-1"></i>
        Account
    </button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">
            <i class="bi bi-person me-2"></i>Profile
        </a></li>
        <li><hr class="dropdown-divider"></li>
        <li>
            <form method="POST" action="#">
                @csrf
                <button type="submit" class="dropdown-item">
                    <i class="bi bi-box-arrow-right me-2"></i>Sign out
                </button>
            </form>
        </li>
    </ul>
</div>
