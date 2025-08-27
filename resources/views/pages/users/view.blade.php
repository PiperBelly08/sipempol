@extends('layouts.master-dashboard')

@section('title', "Rincian {$user->name}")
@section('page-title', "{$user->name}")

@section('breadcrumb')
    <li class="breadcrumb-item {{ request()->url() === route('user.index') ? 'active' : '' }}">
        <a href="{{ route('user.index') }}" class="link-offset-2 link-underline link-underline-opacity-0 text-black">Users</a>
    </li>
    <li class="breadcrumb-item {{ request()->url() === route('user.show', $user->id) ? 'active' : '' }}" aria-current="page">
        {{ $user->name }}
    </li>
@endsection

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Tanggal Bergabung</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at }}</td>
        </tr>
    </tbody>
<table>
@endsection

