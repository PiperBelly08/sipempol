<ul class="nav flex-column py-3">
    @hasrole('customer')
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i>
            Products
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('pesanan.index') }}" class="nav-link {{ request()->routeIs('pesanan.index') ? 'active' : '' }}">
            <i class="bi bi-clipboard-check"></i>
            Orders
        </a>
    </li>
    @endhasrole

    @hasrole('admin')
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i>
            Dashboard
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user.index') }}" class="nav-link {{ request()->routeIs('user.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i>
            Users
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('layanan.index') }}" class="nav-link {{ request()->routeIs('layanan.*') ? 'active' : '' }}">
            <i class="bi bi-box"></i>
            Products
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('pesanan.index') }}" class="nav-link {{ request()->routeIs('pesanan.*') ? 'active' : '' }}">
            <i class="bi bi-clipboard-check"></i>
            Orders
        </a>
    </li>
    @endhasrole

    {{-- <li class="nav-item">
        <a href="#" class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
            <i class="bi bi-bar-chart"></i>
            Reports
        </a>
    </li>

    <li class="nav-item">
        <a href="#" class="nav-link {{ request()->routeIs('settings.*') ? 'active' : '' }}">
            <i class="bi bi-gear"></i>
            Settings
        </a>
    </li> --}}
</ul>
