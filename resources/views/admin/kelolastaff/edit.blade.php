@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit Staff</h2>
    <form action="{{ route('admin.kelolastaff.update', $staff->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $staff->nama }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $staff->email }}" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" required>{{ $staff->alamat }}</textarea>
        </div>
        <div class="mb-3">
            <label for="nohp" class="form-label">No HP</label>
            <input type="text" name="nohp" class="form-control" value="{{ $staff->nohp }}" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" class="form-control" required>
                <option value="satpam" {{ $staff->role == 'satpam' ? 'selected' : '' }}>Satpam</option>
                <option value="guru" {{ $staff->role == 'guru' ? 'selected' : '' }}>Guru</option>
                <option value="bk" {{ $staff->role == 'bk' ? 'selected' : '' }}>BK</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
