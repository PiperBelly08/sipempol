@extends('layouts.master-dashboard')

@section('title', 'Products')
@section('page-title', 'Layanan')

@section('breadcrumb')
    <li class="breadcrumb-item {{ request()->url() === route('user.index') ? 'active' : '' }}" aria-current="page">
        <a href="{{ route('user.index') }}" class="link-offset-2 link-underline link-underline-opacity-0 text-black">Products</a>
    </li>
@endsection

@section('content')
<table class="datatable table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Gambar</th>
            <th><i class="bi bi-gear-fill"></i></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($layanans as $layanan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $layanan->nama }}</td>
                <td>{{ $layanan->deskripsi }}</td>
                <td>{{ $layanan->harga }}</td>
                <td>{{ $layanan->gambar }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('layanan.show', $layanan->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('layanan.edit', $layanan->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUser{{ $layanan->id }}">
                            <i class="bi bi-trash"></i>
                        </button>
                        <div class="modal fade" id="deleteUser{{ $layanan->id }}" tabindex="-1" aria-labelledby="deleteUserLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteUserLabel">Hapus Pengguna</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus layanan <b>{{ $layanan->name }}</b>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <form action="{{ route('layanan.destroy', $layanan->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
