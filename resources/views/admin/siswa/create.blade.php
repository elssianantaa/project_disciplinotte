@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Tambah Siswa</h2>

    <form action="{{ route('admin.siswa.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Foto Siswa</label>
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
        </div>

        <div class="mb-3">
            <label class="form-label">NISN</label>
            <input type="text" name="nisn" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kelas</label>
            <select name="kelas_id" class="form-control" required>
                @foreach($kelas as $k)
                <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="aktif">Aktif</option>
                <option value="skorsing">Skorsing</option>
                <option value="dikeluarkan">Dikeluarkan</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Tambah</button>
        <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
