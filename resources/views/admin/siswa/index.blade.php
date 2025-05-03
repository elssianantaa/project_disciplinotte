@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Daftar Siswa</h2>

    {{-- Form Pencarian --}}
    <form action="{{ route('admin.siswa.index') }}" method="GET" class="mb-4">
        <div class="row g-2 align-items-end">
            <div class="col-md-4">
                <label for="kelas_id" class="form-label">Pilih Kelas:</label>
                <select name="kelas_id" id="kelas_id" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Semua Kelas --</option>
                    @foreach($kelasList as $kelas)
                        <option value="{{ $kelas->id }}" {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                            {{ $kelas->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            @if(request('kelas_id')) {{-- Munculkan hanya jika kelas dipilih --}}
            <div class="col-md-4">
                <label for="nama" class="form-label">Cari Nama Siswa:</label>
                <input type="text" name="nama" id="nama" value="{{ request('nama') }}" class="form-control" placeholder="Masukkan nama">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
            @endif
            <div class="col-md-2">
                <div class="form-label d-block">
                    Jumlah Siswa: <span class="fw-bold">{{ $totalSiswa }}</span>
                </div>      
            </div>
        </div>
    </form>

    <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary mb-3">Tambah Siswa</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

   <div class="table-responsive">
    <table class="table table-bordered align-middle">
        <thead>
            <tr class="text-center">
                <th>NO</th>
                <th>Foto</th>
                <th>NISN</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Jenis Kelamin</th>
                <th>Status</th>
                <th>Point Pelanggaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $siswa)
            <tr>
                <td class="text-center">
                    {{ $students->perPage() * ($students->currentPage() - 1) + $loop->iteration }}
                </td>
                <td class="text-center">
                    <img src="{{ asset('storage/foto_siswa/'.$siswa->foto) }}" alt="Foto Siswa" class="foto-siswa">
                </td>
                <td>{{ $siswa->nisn }}</td>
                <td>{{ $siswa->name }}</td>
                <td>{{ $siswa->kelas->nama_kelas }}</td>
                <td>{{ $siswa->jenis_kelamin }}</td>
                <td>{{ ucfirst($siswa->status) }}</td>
                <td>
                    {{ $siswa->catatanpelanggarans->sum(fn($cp) => $cp->pelanggaran->point ?? 0) }}
                </td>
                <td class="text-center">
                    <a href="{{ route('admin.siswa.edit', $siswa->id) }}" class="btn btn-secondary btn-sm" style="width: 70px;">Edit</a>
                    <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" style="width: 70px;" onclick="return confirm('Yakin ingin menghapus siswa ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center">Data tidak ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div>
    {{ $students->links('pagination::bootstrap-5') }}
</div>


@endsection
