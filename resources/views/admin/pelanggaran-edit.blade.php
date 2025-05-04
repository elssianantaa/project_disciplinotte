@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Pelanggaran</h4>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.pelanggaran.update', $pelanggarans->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_pelanggaran" class="form-label">Nama Pelanggaran</label>
                    <input type="text" name="nama_pelanggaran" class="form-control" value="{{ old('nama_pelanggaran', $pelanggarans->nama_pelanggaran) }}" required>
                </div>

                <div class="mb-3">
                    <label for="point" class="form-label">Point</label>
                    <input type="number" name="point" class="form-control" value="{{ old('point', $pelanggarans->point) }}" required>
                </div>

                <div class="mb-3">
                    <label for="Kategori" class="form-label">Kategori</label>
                    <select name="Kategori" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        <option value="ringan" {{ old('Kategori', $pelanggarans->Kategori) == 'ringan' ? 'selected' : '' }}>Ringan</option>
                        <option value="sedang" {{ old('Kategori', $pelanggarans->Kategori) == 'sedang' ? 'selected' : '' }}>Sedang</option>
                        <option value="berat" {{ old('Kategori', $pelanggarans->Kategori) == 'berat' ? 'selected' : '' }}>Berat</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Update</button>
            </form>

        </div>
    </div>
</div>
@endsection
