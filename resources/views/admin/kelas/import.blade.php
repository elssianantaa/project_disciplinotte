@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Upload Data Kelas</h2>

    {{-- Form Upload File --}}
    <form action="{{ route('kelas.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Pilih File Excel</label>
            <input type="file" name="file" class="form-control" accept=".xlsx, .xls" required>
        </div>

        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
S
    {{-- Menampilkan pesan sukses jika ada --}}
    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif
</div>
@endsection
