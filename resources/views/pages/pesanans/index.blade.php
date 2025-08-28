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
                </td>
                <td>{{ $pesanan->deskripsi_pesan }}</td>
                <td>
                    @if(!isset($pesanan->file_desain))
                        <span class="badge rounded-pill bg-danger">Belum Upload</span>
                    @else
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#showFile{{ $pesanan->id }}">
                            <i class="bi bi-eye"></i>
                        </button>
                        <div class="modal fade" id="showFile{{ $pesanan->id }}" tabindex="-1" aria-labelledby="showFileLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="showFileLabel">File Desain</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{ 'images/' . $pesanan->file_desain }}" class="img-fluid" alt="File Desain" loading="lazy">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </td>
                <td>{{ $pesanan->tanggal_pesan }}</td>
                <td>{{ $pesanan->tanggal_selesai }}</td>
                <td>{{ $pesanan->total_harga }}</td>
                <td>
                    <div class="d-flex gap-2">
                        @role('customer')
                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#uploadDesain{{ $pesanan->id }}">
                            <i class="bi bi-upload"></i>
                        </button>
                        <div class="modal fade" id="uploadDesain{{ $pesanan->id }}" tabindex="-1" aria-labelledby="uploadDesainLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="uploadDesainLabel">Upload Desain</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('pesanan.update', $pesanan->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="status" value="{{ $pesanan->status }}">
                                            <input type="hidden" name="tanggal_pesan" value="{{ $pesanan->tanggal_pesan }}">
                                            <input type="hidden" name="tanggal_selesai" value="{{ $pesanan->tanggal_selesai }}">
                                            <input type="hidden" name="total_harga" value="{{ $pesanan->total_harga }}">
                                            <div class="mb-3">
                                                <label for="file" class="form-label">Desain</label>
                                                <input class="form-control" type="file" id="file" name="file">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Upload</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        <form action="{{ route('pesanan.update', $pesanan->id) }}" method="post" class="d-flex gap-2" onsubmit="return confirm('Yakin dengan pilihanmu?')">
                            @csrf
                            @method('put')
                            <input type="hidden" name="tanggal_pesan" value="{{ $pesanan->tanggal_pesan }}">
                            <input type="hidden" name="tanggal_selesai" value="{{ $pesanan->tanggal_selesai }}">
                            <input type="hidden" name="total_harga" value="5000">
                            <button type="submit" class="btn btn-sm btn-success" name="status" value="Diproses" title="Terima pesanan">
                                <i class="bi bi-check-circle-fill"></i>
                            </button>
                            <button type="submit" class="btn btn-sm btn-danger" name="status" value="Dibatalkan" title="Tolak Pesanan">
                                <i class="bi bi-x-circle-fill"></i>
                            </button>
                        </form>
                        @endif

                        @if ($pesanan->status == 'Diproses')
                        <form action="{{ route('pesanan.update', $pesanan->id) }}" method="post" class="d-flex gap-2" onsubmit="return confirm('Yakin dengan pilihanmu?')">
                            @csrf
                            @method('put')
                            <input type="hidden" name="status" value="{{ $pesanan->status }}">
                            <input type="hidden" name="tanggal_pesan" value="{{ $pesanan->tanggal_pesan }}">
                            <input type="hidden" name="tanggal_selesai" value="{{ $pesanan->tanggal_selesai }}">
                            <input type="hidden" name="total_harga" value="{{ $pesanan->total_harga }}">
                            <button type="submit" class="btn btn-sm btn-success" name="status" value="Selesai" title="Selesaikan pesanan">
                                <i class="bi bi-check-circle-fill"></i>
                            </button>
                            <button type="submit" class="btn btn-sm btn-danger" name="status" value="Dibatalkan" title="Batalkan pesanan">
                                <i class="bi bi-x-circle-fill"></i>
                            </button>
                        </form>
                        @endif

                        @if ($pesanan->status != 'Pending' && $pesanan->status != 'Selesai' && $pesanan->status != 'Dibatalkan')
                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#uploadDesain{{ $pesanan->id }}">
                                <i class="bi bi-upload"></i>
                            </button>
                            <div class="modal fade" id="uploadDesain{{ $pesanan->id }}" tabindex="-1" aria-labelledby="uploadDesainLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="uploadDesainLabel">Upload Desain</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('pesanan.update', $pesanan->id) }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" name="status" value="{{ $pesanan->status }}">
                                                <input type="hidden" name="tanggal_pesan" value="{{ $pesanan->tanggal_pesan }}">
                                                <input type="hidden" name="tanggal_selesai" value="{{ $pesanan->tanggal_selesai }}">
                                                <input type="hidden" name="total_harga" value="{{ $pesanan->total_harga }}">
                                                <div class="mb-3">
                                                    <label for="file" class="form-label">Desain</label>
                                                    <input class="form-control" type="file" id="file" name="file">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Upload</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editPesanan{{ $pesanan->id }}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <div class="modal fade" id="editPesanan{{ $pesanan->id }}" tabindex="-1" aria-labelledby="editPesananLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editPesananLabel">Perbarui Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('pesanan.update', $pesanan->id) }}" method="post">
                                                @csrf
                                                @method('put')

                                                <input type="hidden" name="status" value="{{ $pesanan->status }}">
                                                <div class="mb-3">
                                                    <label for="tanggal_pesan" class="form-label">Tanggal Pesan</label>
                                                    <input class="form-control" type="date" id="tanggal_pesan" name="tanggal_pesan" value="{{ $pesanan->tanggal_pesan }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                                                    <input class="form-control" type="date" id="tanggal_selesai" name="tanggal_selesai" value="{{ $pesanan->tanggal_selesai }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="total_harga" class="form-label">Total Harga</label>
                                                    <input class="form-control" type="number" inputmode="numeric" min="5000" step="5000" id="total_harga" name="total_harga" value="{{ (int) $pesanan->total_harga }}">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Perbarui</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <a href="{{ route('pesanan.edit', $pesanan->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a> --}}

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
