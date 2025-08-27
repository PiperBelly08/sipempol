@extends('layouts.master-dashboard')

@section('title', "Edit {$layanan->nama}")
@section('page-title', "{$layanan->nama}")

@section('breadcrumb')
    <li class="breadcrumb-item {{ request()->url() === route('layanan.index') ? 'active' : '' }}">
        <a href="{{ route('layanan.index') }}" class="link-offset-2 link-underline link-underline-opacity-0 text-black">Products</a>
    </li>
    <li class="breadcrumb-item {{ request()->url() === route('layanan.show', $layanan->id) ? 'active' : '' }}" aria-current="page">
        {{ $layanan->nama }}
    </li>
@endsection

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Gambar</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $layanan->nama }}</td>
            <td>{{ $layanan->deskripsi }}</td>
            <td>{{ $layanan->harga }}</td>
            <td>{{ $layanan->gambar }}</td>
        </tr>
    </tbody>
<table>
@endsection

