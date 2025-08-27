@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold" href="#">Dashboard App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Settings</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Offcanvas Sidebar -->
    <div class="offcanvas offcanvas-start bg-dark text-white sidebar-nav" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-body p-0">
            <nav class="navbar-dark">
                <ul class="navbar-nav">
                    <li>
                        <div class="text-muted small fw-bold text-uppercase px-3">
                            CORE
                        </div>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-3 active">
                            <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="my-4"><hr class="dropdown-divider"></li>
                    <li>
                        <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
                            INTERFACE
                        </div>
                    </li>
                    <li>
                        <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <span class="me-2"><i class="bi bi-layout-text-sidebar-reverse"></i></span>
                            <span>Layouts</span>
                            <span class="right-icon ms-auto"><i class="bi bi-chevron-down"></i></span>
                        </a>
                        <div class="collapse" id="collapseExample">
                            <ul class="navbar-nav ps-3">
                                <li>
                                    <a href="#" class="nav-link px-3">
                                        <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                                        <span>Item 1</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-3">
                                        <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                                        <span>Item 2</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-3">
                            <span class="me-2"><i class="bi bi-book-half"></i></span>
                            <span>Pages</span>
                        </a>
                    </li>
                    <li class="my-4"><hr class="dropdown-divider"></li>
                    <li>
                        <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
                            ADDONS
                        </div>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-3">
                            <span class="me-2"><i class="bi bi-graph-up"></i></span>
                            <span>Charts</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-3">
                            <span class="me-2"><i class="bi bi-table"></i></span>
                            <span>Tables</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Main Content Wrapper -->
    <main class="mt-5 pt-3">
        <div class="container-fluid">
            <!-- Dashboard Cards -->
            <div class="row g-4">
                <!-- Card 1: Total Users -->
                <div class="col-md-4">
                    <div class="card shadow-sm rounded">
                        <div class="card-body">
                            <h5 class="card-title text-muted">Total Users</h5>
                            <h1 class="display-4">2,567</h1>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Total Sales -->
                <div class="col-md-4">
                    <div class="card shadow-sm rounded">
                        <div class="card-body">
                            <h5 class="card-title text-muted">Total Sales</h5>
                            <h1 class="display-4">$15,450</h1>
                        </div>
                    </div>
                </div>

                <!-- Card 3: New Orders -->
                <div class="col-md-4">
                    <div class="card shadow-sm rounded">
                        <div class="card-body">
                            <h5 class="card-title text-muted">New Orders</h5>
                            <h1 class="display-4">124</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section: Recent Activity Table -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card shadow-sm rounded">
                        <div class="card-header bg-primary text-white">
                            Recent Activity
                        </div>
                        <div class="card-body">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Activity</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">#1001</th>
                                        <td>New user registered</td>
                                        <td>2024-05-20</td>
                                        <td><span class="badge bg-success">Success</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">#1002</th>
                                        <td>Order placed</td>
                                        <td>2024-05-19</td>
                                        <td><span class="badge bg-info">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">#1003</th>
                                        <td>Report generated</td>
                                        <td>2024-05-18</td>
                                        <td><span class="badge bg-secondary">Completed</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <style>
        @import url('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css');

        body {
            background-color: #f8f9fa;
        }

        @media (min-width: 992px) {
            body {
                overflow: auto !important;
            }
            main {
                margin-left: 240px;
            }
            .sidebar-nav {
                transform: none !important;
                visibility: visible !important;
                top: 56px;
                height: calc(100vh - 56px);
                position: fixed;
                width: 240px;
            }
            .offcanvas-backdrop::before {
                display: none;
            }
        }

        .sidebar-nav .nav-link {
            transition: all 0.3s ease;
        }

        .sidebar-nav .nav-link.active,
        .sidebar-nav .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar-link[aria-expanded="true"] .right-icon {
            transform: rotate(180deg);
        }

    </style>
@endsection
