@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Kelola Staff</h2>
    <a href="{{ route('admin.kelolastaff.create') }}" class="btn btn-primary mb-3">Tambah Staff</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($staffs as $staff)
            <tr>
                <td>{{ $loop->iteration }}
                <td>{{ $staff->nama }}</td>
                <td>{{ $staff->email }}</td>
                <td>{{ $staff->alamat }}</td>
                <td>{{ $staff->nohp }}</td>
                <td>{{ ucfirst($staff->role) }}</td>
                <td>
                    <a href="{{ route('admin.kelolastaff.edit', $staff->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.kelolastaff.destroy', $staff->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection