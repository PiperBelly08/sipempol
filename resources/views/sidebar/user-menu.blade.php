@php
    function rand_str($length): string
    {
        $characters = '0123456789abcdef';
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $string;
    }
@endphp

<div class="d-flex align-items-center mb-2">
    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}&color={{ rand_str(6) }}&background={{ rand_str(6) }}" alt="User Avatar" class="user-avatar rounded-circle me-2">

    <div class="flex-grow-1">
        <div class="text-white small fw-semibold">{{ auth()->user()->name ?? 'Guest User' }}</div>
        <div class="text-light small">{{ auth()->user()->email ?? 'guest@example.com' }}</div>
    </div>
</div>
<div class="dropdown">
    <button class="btn btn-outline-light btn-sm dropdown-toggle w-100" type="button"
            data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-person-circle me-1"></i>
        Account
    </button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('profil.show', auth()->user()->id) }}">
            <i class="bi bi-person me-2"></i>Profile
        </a></li>
        <li><hr class="dropdown-divider"></li>
        <li>
            <form method="POST" action="{{ route('login.destroy') }}">
                @csrf
                <button type="submit" class="dropdown-item">
                    <i class="bi bi-box-arrow-right me-2"></i>Sign out
                </button>
            </form>
        </li>
    </ul>
</div>
