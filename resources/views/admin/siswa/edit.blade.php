@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit Siswa</h2>

    <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="form-label">Foto Siswa</label>
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
            @if($siswa->foto)
                <p><img src="{{ asset('storage/foto_siswa/' . $siswa->foto) }}" alt="Foto" width="100"></p>
            @endif

        </div>
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" value="{{ $siswa->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kelas</label>
            <select name="kelas_id" class="form-control" required>
                @foreach($kelas as $k)
                <option value="{{ $k->id }}" {{ $siswa->kelas_id == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="Laki-laki" {{ $siswa->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ $siswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="aktif" {{ $siswa->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="skorsing" {{ $siswa->status == 'skorsing' ? 'selected' : '' }}>Skorsing</option>
                <option value="dikeluarkan" {{ $siswa->status == 'dikeluarkan' ? 'selected' : '' }}>Dikeluarkan</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100px;">Update</button>
        <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary" style="width: 100px;">Batal</a>

    </form>
</div>
@endsection
