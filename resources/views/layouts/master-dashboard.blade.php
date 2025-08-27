<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ config('app.name', 'SIPEMPOL') }} - @yield('title', 'Dashboard')</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('meta')
    @include('layouts.primary-library')

    <!-- Custom Styles -->
    <style>
        .sidebar {
            min-height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            transition: all 0.3s;
        }

        .sidebar .nav-link {
            color: #adb5bd;
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            margin: 0.125rem 0.5rem;
            transition: all 0.15s ease-in-out;
        }

        .sidebar .nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar .nav-link.active {
            color: #fff;
            background-color: #0d6efd;
        }

        .sidebar .nav-link i {
            width: 20px;
            text-align: center;
            margin-right: 0.5rem;
        }

        .main-content {
            margin-left: 250px;
            transition: all 0.3s;
        }

        .sidebar-brand {
            padding: 1rem;
            border-bottom: 1px solid #495057;
        }

        .sidebar-brand a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.25rem;
        }

        .user-info {
            border-top: 1px solid #495057;
            padding: 1rem;
            margin-top: auto;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
        }

        .top-navbar {
            background-color: #fff;
            border-bottom: 1px solid #dee2e6;
            padding: 1rem 1.5rem;
        }

        .content-wrapper {
            padding: 1.5rem;
        }

        @media (max-width: 768px) {
            .sidebar {
                margin-left: -250px;
            }

            .sidebar.show {
                margin-left: 0;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>

    @stack('styles')
    @stack('scripts-defer')
</head>
<body>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar d-flex flex-column">
            <!-- Brand -->
            <div class="sidebar-brand">
                <a href="{{ route('dashboard') }}">
                    <i class="bi bi-bootstrap me-2"></i>
                    {{ config('app.name', 'SIPEMPOL') }}
                </a>
            </div>

            <!-- Navigation Menu -->
            <div class="flex-grow-1">
                @include('sidebar.navigation-menu')
            </div>

            <!-- User Menu -->
            <div class="user-info">
                @include('sidebar.user-menu')
            </div>
        </nav>

        <!-- Main Content -->
        <main class="main-content flex-grow-1">
            <!-- Top Navigation Bar -->
            @include('sidebar.main')
        </main>
    </div>

    <!-- Custom JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile sidebar toggle
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });
            }

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768) {
                    if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                        sidebar.classList.remove('show');
                    }
                }
            });

            console.log('SIPEMPOL Bootstrap 5 Layout loaded');
        });
    </script>

    <!-- Additional Scripts -->
    @stack('scripts')
</body>
</html>
