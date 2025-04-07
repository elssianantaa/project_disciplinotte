@extends('layouts.admin')

@section('content')
<h4 style="margin-top: 3%">Manage Users</h4>

<div class="row mb-3 align-items-center">
    <div class="col-md-4">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Tambah User</a>
    </div>
    <div class="col-md-4"></div> 
    <div class="col-md-4">
        <div class="form-label">
            Jumlah Siswa: <span class="fw-bold">{{ $totalSiswa }}</span>
        </div>
    </div>
</div>


    <table class="table table-bordered">
        <thead>
            <tr style="text-align: center">
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>NO HP</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $key => $user)
            <tr>
                <td style="text-align: center">{{ $key + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>{{ $user->nohp }}</td>
                <td>{{ $user->address }}</td>
                <td style="text-align: center">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-secondary btn-sm" style="width: 70px;">Edit</a>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" style="width: 70px;" onclick="return confirm('Yakin ingin menghapus siswa ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
