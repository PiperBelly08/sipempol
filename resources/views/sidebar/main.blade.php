<header class="top-navbar">
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <!-- Mobile menu toggle -->
            <button class="btn btn-outline-secondary d-md-none me-3" type="button" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>

            <div>
                <h1 class="h3 mb-0 text-gray-800">@yield('page-title', 'Dashboard')</h1>
                @hasSection('breadcrumb')
                    <nav aria-label="breadcrumb" class="mt-1">
                        <ol class="breadcrumb breadcrumb-sm mb-0">
                            @yield('breadcrumb')
                        </ol>
                    </nav>
                @endif
            </div>
        </div>

        <!-- Top bar actions -->
        <div class="d-flex align-items-center invisible">
            <!-- Search -->
            <div class="me-3">
                <div class="input-group" style="width: 250px;">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="search" class="form-control border-start-0" placeholder="Search..." style="box-shadow: none;">
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Flash Messages -->
<div class="content-wrapper">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>
            <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>
            <strong>Please correct the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Page Content -->
    @yield('content')
</div>
