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
        <h2 class="text-center mb-4">Register</h2>
        <form method="POST" action="{{ route('register.post') }}">
            @csrf

            <!-- Name input field -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name">
            </div>

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

            <!-- Confirm password input field -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
            </div>

            <!-- Register button -->
            <button type="submit" class="btn btn-primary">Register</button>

        </form>

        <!-- Link for new users to login -->
        <div class="text-center mt-3">
            <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
        </div>
    </div>
</div>
@endsection
