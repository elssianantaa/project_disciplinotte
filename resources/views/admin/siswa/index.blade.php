@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Daftar Siswa</h2>
    <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary mb-3">Tambah Siswa</a>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NO</th>
                <th>Foto</th>
                <th>NISN</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Jenis Kelamin</th>
                <th>Status</th>
                <th>Point</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $siswa)
            <tr>
                <td>{{ $loop->iteration }}
                <td><img src="{{ asset('storage/foto_siswa/'.$siswa->foto) }}" alt="" style="width: 50px; height: 50px;"></td>
                <td>{{ $siswa->nisn }}</td>
                <td>{{ $siswa->name }}</td>
                <td>{{ $siswa->kelas->nama_kelas }}</td>
                <td>{{ $siswa->jenis_kelamin == 'Laki-laki' ? 'Laki-laki' : 'Perempuan' }}</td>
                <td>{{ ucfirst($siswa->status) }}</td>
                <td>{{ $siswa->point ?? '0' }}</td>
                <td>
                    <a href="{{ route('admin.siswa.edit', $siswa->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus siswa ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
