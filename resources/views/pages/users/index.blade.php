@extends('layouts.master-dashboard')

@section('title', 'Users')
@section('page-title', 'Users')

@section('breadcrumb')
    <li class="breadcrumb-item {{ request()->url() === route('user.index') ? 'active' : '' }}" aria-current="page">
        <a href="{{ route('user.index') }}" class="link-offset-2 link-underline link-underline-opacity-0 text-black">Users</a>
    </li>
@endsection

@section('content')
<table class="datatable table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Tanggal Bergabung</th>
            <th><i class="bi bi-gear-fill"></i></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('user.show', $user->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('user.destroy', $user->id) }}" method="post" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
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
