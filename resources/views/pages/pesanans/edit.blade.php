@extends('layouts.master-dashboard')

@section('title', "Edit {$pesanan->name}")
@section('page-title', "{$pesanan->name}")

@section('breadcrumb')
    <li class="breadcrumb-item {{ request()->url() === route('pesanan.index') ? 'active' : '' }}">
        <a href="{{ route('pesanan.index') }}" class="link-offset-2 link-underline link-underline-opacity-0 text-black">Products</a>
    </li>
    <li class="breadcrumb-item {{ request()->url() === route('pesanan.show', $pesanan->id) ? 'active' : '' }}" aria-current="page">
        {{ $pesanan->name }}
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
            <td>{{ $pesanan->nama }}</td>
            <td>{{ $pesanan->deskripsi }}</td>
            <td>{{ $pesanan->harga }}</td>
            <td>{{ $pesanan->gambar }}</td>
        </tr>
    </tbody>
<table>
@endsection

