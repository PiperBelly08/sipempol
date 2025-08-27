@extends('layouts.master-dashboard')

@role('admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@endrole

@hasrole('customer')
    @section('breadcrumb')
    <li class="breadcrumb-item {{ request()->url() === route('dashboard') ? 'active' : '' }}" aria-current="page">
        <a href="{{ route('dashboard') }}" class="link-offset-2 link-underline link-underline-opacity-0 text-black">Layanan</a>
    </li>
    @endsection
@endhasrole

@role('customer')
@section('title', 'Products')
@section('page-title', 'Layanan')
@endrole

@section('content')
@hasrole('admin')
<div class="row">
    <div class="col-md-3">
        <div class="card bg-primary">
            <div class="card-body">
                <h5 class="card-title">Jumlah Pelanggan</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success">
            <div class="card-body">
                <h5 class="card-title">Jumlah Layanan</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info">
            <div class="card-body">
                <h5 class="card-title">Jumlah Pesanan</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning">
            <div class="card-body">
                <h5 class="card-title">Jumlah Pesanan Menunggu</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
    </div>
</div>
@endhasrole

@hasrole('customer')
<div class="row">
    @foreach ($layanans as $layanan)
    <div class="col-md-4 mb-4">
        <form class="card h-100" method="POST" action="{{ route('pesanan.store') }}">
            @csrf

            <input type="hidden" name="layanan_id" value="{{ $layanan->id }}">

            <img src="{{ $layanan->gambar ? asset('storage/' . $layanan->gambar) : 'https://placehold.co/600x400' }}" class="card-img-top img-fluid" alt="{{ $layanan->nama }}">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $layanan->nama }}</h5>
                <p class="card-text">{{ Str::limit($layanan->deskripsi, 100) }}</p>
                <p class="card-text mt-auto"><strong>Harga: </strong>Rp {{ number_format($layanan->harga, 0, ',', '.') }}</p>
                <button type="submit" class="btn btn-primary mt-2">Pesan Sekarang</button>
            </div>
        </form>
    </div>
    @endforeach
</div>
@endhasrole
@endsection
