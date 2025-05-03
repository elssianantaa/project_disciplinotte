@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Pelanggaran</h2>
        <a href="{{ route('admin.pelanggaran.create') }}" class="btn btn-primary">Tambah Pelanggaran</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggaran</th>
                    <th>Skor</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pelanggarans as $pelanggaran)
                <tr>
                    <td>{{ $pelanggaran->id }}</td>
                    <td>{{ $pelanggaran->nama_pelanggaran }}</td>
                    <td>{{ $pelanggaran->point }}</td>
                    <td>{{ $pelanggaran->Kategori }}</td>
                    <td>
                        <a href="{{ route('admin.pelanggaran.edit', $pelanggaran->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                        <form action="{{ route('admin.pelanggaran.destroy', $pelanggaran->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus data ini?')" type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada data pelanggaran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
