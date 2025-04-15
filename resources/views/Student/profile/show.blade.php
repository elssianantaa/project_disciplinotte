@extends('layouts.siswa') {{-- Kalau kamu pakai layout --}}
@section('content')
<div class="container mt-5">
    <h3>Profil Siswa</h3>
    <table class="table">
        <tr><th>NISN</th><td>{{ $student->nisn }}</td></tr>
        <tr><th>Nama</th><td>{{ $student->name }}</td></tr>
        <tr><th>Kelas</th><td>{{ $student->kelas }}</td></tr>
        <tr><th>Alamat</th><td>{{ $student->alamat }}</td></tr>
        <!-- Tambahkan data lainnya sesuai kebutuhan -->
    </table>
    <a href="{{ route('Student.profile.edit', $student->id) }}" class="btn btn-warning">Edit Profil</a>
</div>
@endsection
