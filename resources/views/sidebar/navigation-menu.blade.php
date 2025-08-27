<ul class="nav flex-column py-3">
    <li class="nav-item">
        <a href="#"
           class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i>
            Dashboard
        </a>
    </li>

    <li class="nav-item">
        <a href="#"
           class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i>
            Users
        </a>
    </li>

    <li class="nav-item">
        <a href="#"
           class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
            <i class="bi bi-box"></i>
            Products
        </a>
    </li>

    <li class="nav-item">
        <a href="#"
           class="nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}">
            <i class="bi bi-clipboard-check"></i>
            Orders
        </a>
    </li>

    <li class="nav-item">
        <a href="#"
           class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
            <i class="bi bi-bar-chart"></i>
            Reports
        </a>
    </li>

    <li class="nav-item">
        <a href="#"
           class="nav-link {{ request()->routeIs('settings.*') ? 'active' : '' }}">
            <i class="bi bi-gear"></i>
            Settings
        </a>
    </li>
</ul>
