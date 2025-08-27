@extends('layouts.master-dashboard')

@section('title', "Data Pesanan")
@section('page-title', "Data Pesanan")

@section('breadcrumb')
    <li class="breadcrumb-item {{ request()->url() === route('pesanan.index') ? 'active' : '' }}">
        <a href="{{ route('pesanan.index') }}" class="link-offset-2 link-underline link-underline-opacity-0 text-black">Orders</a>
    </li>
    <li class="breadcrumb-item {{ request()->url() === route('pesanan.show', $pesanan->id) ? 'active' : '' }}" aria-current="page">
        {{ $pesanan->id }}
    </li>
@endsection

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>Nama Pelanggan</th>
            <th>Layanan</th>
            <th>Status</th>
            <th>Deskripsi</th>
            <th>File</th>
            <th>Jumlah</th>
            <th>Tanggal Pesan</th>
            <th>Tanggal Selesai</th>
            <th>Total Harga</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $pesanan->pelanggan->nama }}</td>
            <td>{{ $pesanan->layanan->nama }}</td>
            <td>{{ $pesanan->status }}</td>
            <td>{{ $pesanan->deskripsi_pesan }}</td>
            <td>{{ $pesanan->file_desain }}</td>
            <td>{{ $pesanan->jumlah_pemesanan }}</td>
            <td>{{ $pesanan->tanggal_pesan }}</td>
            <td>{{ $pesanan->tanggal_selesai }}</td>
            <td>{{ $pesanan->total_harga }}</td>
        </tr>
    </tbody>
<table>
@endsection
