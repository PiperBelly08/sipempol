@extends('layouts.master-dashboard')

@section('title', 'Products')
@section('page-title', 'Layanan')

@section('breadcrumb')
    <li class="breadcrumb-item {{ request()->url() === route('user.index') ? 'active' : '' }}" aria-current="page">
        <a href="{{ route('user.index') }}" class="link-offset-2 link-underline link-underline-opacity-0 text-black">Products</a>
    </li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h1 class="mb-0 invisible">Layanan</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLayananModal">
        <i class="bi bi-plus-circle"></i> Tambah Layanan
    </button>
</div>

<div class="modal fade" id="addLayananModal" tabindex="-1" aria-labelledby="addLayananModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLayananModalLabel">Tambah Layanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('layanan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" inputmode="numeric" min="5000" step="5000" required>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" accept=".png, .jpg, .jpeg">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
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
                <td>Rp{{ number_format($layanan->harga, 0, ',', '.') }}</td>
                <td>
                    @if(!isset($layanan->gambar))
                        <span class="badge rounded-pill bg-danger">Belum Upload</span>
                    @else
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#showFile{{ $layanan->id }}">
                            <i class="bi bi-eye"></i>
                        </button>
                        <div class="modal fade" id="showFile{{ $layanan->id }}" tabindex="-1" aria-labelledby="showFileLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="showFileLabel">File Desain</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{ 'images/layanan/' . $layanan->gambar }}" class="img-fluid" alt="File Desain" loading="lazy">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#uploadDesain{{ $layanan->id }}">
                            <i class="bi bi-upload"></i>
                        </button>
                        <div class="modal fade" id="uploadDesain{{ $layanan->id }}" tabindex="-1" aria-labelledby="uploadDesainLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="uploadDesainLabel">Upload Gambar</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('layanan.update', $layanan->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="nama" value="{{ $layanan->nama }}">
                                            <input type="hidden" name="deskripsi" value="{{ $layanan->deskripsi }}">
                                            <input type="hidden" name="harga" value="{{ $layanan->harga }}">
                                            <div class="mb-3">
                                                <label for="file" class="form-label">Gambar</label>
                                                <input class="form-control" type="file" id="file" name="file">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Upload</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <a href="{{ route('layanan.show', $layanan->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-eye"></i></a> --}}
                        {{-- <a href="{{ route('layanan.edit', $layanan->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a> --}}
                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editLayanan{{ $layanan->id }}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <div class="modal fade" id="editLayanan{{ $layanan->id }}" tabindex="-1" aria-labelledby="editLayananLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editLayananLabel">Perbarui Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('layanan.update', $layanan->id) }}" method="post">
                                            @csrf
                                            @method('put')

                                            <input type="hidden" name="status" value="{{ $layanan->status }}">
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama</label>
                                                <input class="form-control" type="input" id="nama" name="nama" value="{{ $layanan->nama }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                                <input class="form-control" type="input" id="deskripsi" name="deskripsi" value="{{ $layanan->deskripsi }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="harga" class="form-label">Harga</label>
                                                <input class="form-control" type="number" inputmode="numeric" min="5000" step="5000" id="harga" name="harga" value="{{ (int) $layanan->harga }}">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Perbarui</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                                        Apakah Anda yakin ingin menghapus layanan <b>{{ $layanan->nama }}</b> ini?
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
