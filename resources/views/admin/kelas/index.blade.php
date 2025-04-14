@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Data Kelas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Form upload file Excel -->
    <form action="{{ route('kelas.import') }}" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="file" class="form-label">Upload Data Kelas (Excel)</label>
            <input type="file" class="form-control" id="file" name="file" accept=".xlsx, .xls" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>

    <!-- Tabel Daftar Kelas -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kelas</th>
                <th>Wali Kelas</th>
                <th>Jurusan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kelas as $k)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $k->nama_kelas }}</td>
                <td>{{ $k->wali_kelas }}</td>
                <td>{{ $k->jurusan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
