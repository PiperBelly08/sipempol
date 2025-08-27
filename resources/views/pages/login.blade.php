@extends('layouts.master')

@section('title', 'Login')

@push('styles')
<style>
    body {
        background-color: #f8f9fa;
    }

    .login-container {
        max-width: 400px;
        margin: 50px auto;
        padding: 40px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .form-label {
        font-weight: 500;
    }

    .btn-primary {
        width: 100%;
        border-radius: 5px;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #0d6efd;
    }

    .form-check-label a {
        color: #0d6efd;
        text-decoration: none;
    }

    .form-check-label a:hover {
        text-decoration: underline;
    }
</style>
@endpush

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="login-container">
        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <hr>
        @endif
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h2 class="text-center mb-4">Login</h2>
        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <!-- Email input field -->
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
            </div>

            <!-- Password input field -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>

            <!-- Checkbox for "Remember Me" and "Forgot Password" link -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Remember me</label>
                </div>
                <a href="#" class="text-decoration-none">Forgot Password?</a>
            </div>

            <!-- Login button -->
            <button type="submit" class="btn btn-primary">Login</button>
        </form>

        <!-- Link for new users to register -->
        <div class="text-center mt-3">
            <p>Don't have an account? <a href="#">Register here</a></p>
        </div>
    </div>
</div>
@endsection
