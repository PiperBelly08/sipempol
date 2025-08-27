@extends('layouts.master-dashboard')

@section('title', 'Products')
@section('page-title', 'Pesanan')

@section('breadcrumb')
    <li class="breadcrumb-item {{ request()->url() === route('user.index') ? 'active' : '' }}" aria-current="page">
        <a href="{{ route('user.index') }}" class="link-offset-2 link-underline link-underline-opacity-0 text-black">Orders</a>
    </li>
@endsection

@section('content')
<table class="datatable table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Pelanggan</th>
            <th>Layanan</th>
            <th>Status</th>
            <th>Deskripsi</th>
            <th>File</th>
            <th>Tanggal Pesan</th>
            <th>Tanggal Selesai</th>
            <th>Total Harga</th>
            <th><i class="bi bi-gear-fill"></i></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pesanans as $pesanan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pesanan->pelanggan->nama }}</td>
                <td>{{ $pesanan->layanan->nama }}</td>
                <td>
                    <div class="d-flex gap-1">
                        @switch($pesanan->status)
                            @case('Pending')
                                <span class="badge rounded-pill bg-warning text-dark">{{ $pesanan->status }}</span>
                            @break

                            @case('Diproses')
                                <span class="badge rounded-pill bg-primary">{{ $pesanan->status }}</span>
                            @break

                            @case('Selesai')
                                <span class="badge rounded-pill bg-success">{{ $pesanan->status }}</span>
                            @break

                            @case('Dibatalkan')
                                <span class="badge rounded-pill bg-danger">{{ $pesanan->status }}</span>
                            @break
                        @endswitch
                    </div>
                </td>
                <td>{{ $pesanan->deskripsi_pesan }}</td>
                <td>{{ $pesanan->file_desain }}</td>
                <td>{{ $pesanan->tanggal_pesan }}</td>
                <td>{{ $pesanan->tanggal_selesai }}</td>
                <td>{{ $pesanan->total_harga }}</td>
                <td>
                    <div class="d-flex gap-2">
                        @role('customer')
                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUser{{ $pesanan->id }}">
                            <i class="bi bi-trash"></i>
                        </button>
                        <div class="modal fade" id="deleteUser{{ $pesanan->id }}" tabindex="-1" aria-labelledby="deleteUserLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteUserLabel">Hapus Pengguna</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus pesanan ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <form action="{{ route('pesanan.destroy', $pesanan->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endrole

                        @role('admin')

                        @if ($pesanan->status == 'Pending')
                        <form action="{{ route('pesanan.update', $pesanan->id) }}" method="post" class="d-flex gap-2">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-sm btn-success" name="status" value="Diproses" title="terima?"><i class="bi bi-check-circle-fill"></i></button>
                            <button type="submit" class="btn btn-sm btn-danger" name="status" value="Dibatalkan" title="tolak?"><i class="bi bi-x-circle-fill"></i></button>
                        </form>
                        @endif

                        @if ($pesanan->status != 'Pending')
                        <a href="{{ route('pesanan.show', $pesanan->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('pesanan.edit', $pesanan->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>

                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUser{{ $pesanan->id }}">
                            <i class="bi bi-trash"></i>
                        </button>
                        <div class="modal fade" id="deleteUser{{ $pesanan->id }}" tabindex="-1" aria-labelledby="deleteUserLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteUserLabel">Hapus Pengguna</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus pesanan ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <form action="{{ route('pesanan.destroy', $pesanan->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endrole
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
<table>
@endsection

@push('scripts')
<script>
const table = new DataTable('.datatable', {
    language: {
        url: 'https://cdn.datatables.net/plug-ins/2.3.3/i18n/id.json',
    },
});
</script>
@endpush
