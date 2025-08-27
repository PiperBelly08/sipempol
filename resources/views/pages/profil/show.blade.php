@extends('layouts.master-dashboard')

@section('title', "{$user->name}")
@section('page-title', "{$user->name}")

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
        </tr>
    </tbody>
<table>
@endsection

