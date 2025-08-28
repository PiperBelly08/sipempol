@extends('layouts.master-dashboard')

@role('admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard Sistem Informasi Pendaftaran & Pemesanan Online')
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
@section('page-title', 'Layanan Sistem Informasi Pendaftaran & Pemesanan Online')
@endrole

@section('content')
@hasrole('admin')
<div class="row">
    @foreach ([
        ['title' => 'Jumlah Pelanggan', 'count' => $customers, 'route' => 'user.index', 'color' => 'light', 'icon' => 'bi-people-fill'],
        ['title' => 'Jumlah Layanan', 'count' => $layanans->count(), 'route' => 'layanan.index', 'color' => 'light', 'icon' => 'bi-box'],
        ['title' => 'Jumlah Pesanan', 'count' => $orders->count(), 'route' => 'pesanan.index', 'color' => 'light', 'icon' => 'bi-clipboard-check'],
    ] as $card)
    <div class="col-md-4 mb-3">
        <div class="card text-dark bg-{{ $card['color'] }}">
            <div class="card-body">
                <div class="d-flex mb-3">
                    <i class="{{ $card['icon'] }} fs-1"></i>
                    <div class="ms-3">
                        <h5 class="card-title">{{ $card['title'] }}</h5>
                        <p class="card-text"><b>{{ $card['count'] }}</b></p>
                    </div>
                </div>
                <a href="{{ route($card['route']) }}" class="btn btn-sm d-block btn-outline-dark">Lihat Semua</a>
            </div>
        </div>
    </div>
    @endforeach
    @foreach ([
        ['title' => 'Pesanan Menunggu', 'count' => $pendingOrders, 'route' => 'pesanan.index', 'color' => 'light', 'icon' => 'bi-clock'],
        ['title' => 'Pesanan Diproses', 'count' => $processedOrders, 'route' => 'pesanan.index', 'color' => 'light', 'icon' => 'bi-gear'],
        ['title' => 'Pesanan Selesai', 'count' => $doneOrders, 'route' => 'pesanan.index', 'color' => 'light', 'icon' => 'bi-check-circle-fill'],
        ['title' => 'Pesanan Dibatalkan', 'count' => $cancelledOrders, 'route' => 'pesanan.index', 'color' => 'light', 'icon' => 'bi-x-circle-fill']
    ] as $card)
    <div class="col-md-3 mb-3">
        <div class="card text-dark bg-{{ $card['color'] }}">
            <div class="card-body">
                <div class="d-flex mb-3" style="height: 80px;">
                    <i class="{{ $card['icon'] }} fs-1"></i>
                    <div class="ms-3">
                        <h5 class="card-title">{{ $card['title'] }}</h5>
                        <p class="card-text"><b>{{ $card['count'] }}</b></p>
                    </div>
                </div>
                <a href="{{ route($card['route']) }}" class="btn btn-sm d-block btn-outline-dark">Lihat Semua</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endhasrole

@hasrole('customer')
<div class="row">
    @foreach ($layanans as $layanan)
    <div class="col-md-4 mb-4">
        <form class="card h-100" method="POST" action="{{ route('pesanan.store') }}" enctype="multipart/form-data">
            @csrf

            @php
                $pelanggan_id = App\Models\User::find(auth()->id())->pelanggan->id;
            @endphp
            <input type="hidden" name="layanan_id" value="{{ $layanan->id }}">
            <input type="hidden" name="pelanggan_id" value="{{ $pelanggan_id }}">
            <input type="hidden" name="tanggal_pesan" value="{{ date('Y-m-d') }}">
            <input type="hidden" name="total_harga" value="{{ $layanan->harga }}">
            <input type="hidden" name="status" value="Pending">
            <img src="{{ $layanan->gambar ? 'images/layanan/' . $layanan->gambar : 'https://placehold.co/600x400' }}" class="card-img-top img-fluid" alt="{{ $layanan->nama }}">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $layanan->nama }}</h5>
                <p class="card-text">{{ Str::limit($layanan->deskripsi, 100) }}</p>
                <p class="card-text mt-auto"><strong>Harga: </strong>Rp{{ number_format($layanan->harga, 0, ',', '.') }}</p>
                <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#pesanLayanan{{ $layanan->id }}">
                    Pesan Sekarang
                </button>
            </div>
            <div class="modal fade" id="pesanLayanan{{ $layanan->id }}" tabindex="-1" aria-labelledby="pesanLayananLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="pesanLayananLabel">Konfirmasi Pesanan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="deskripsi_pesan" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi_pesan" name="deskripsi_pesan"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">Desain</label>
                                <input class="form-control" type="file" id="file" name="file">
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                                <input class="form-control" type="date" id="tanggal_selesai" name="tanggal_selesai" min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <p>Dengan ini, Anda akan memesan layanan <strong>{{ $layanan->nama }}</strong> dengan harga <strong>Rp{{ number_format($layanan->harga, 0, ',', '.') }}</strong>.<br>
                            Jika Anda yakin dengan pemesanan Anda, silakan klik tombol "Ya, Pesan Sekarang".</p>
                            <small>
                                <p class="text-muted"><i>Catatan: Harga akhir dapat berubah sesuai dengan permintaan desain</i></p>
                            </small>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Ya, Pesan Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @endforeach
</div>
@endhasrole
@endsection
