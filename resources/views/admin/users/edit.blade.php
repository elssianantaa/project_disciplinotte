@extends('layouts.admin')

@section('content')

    <div class="container mt-4">
        <h1>{{ isset($user) ? 'Edit User' : 'Tambah User' }}</h1>
        <form action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}" method="POST">
            @csrf
            @if (isset($user))
                @method('PUT')
            @endif

            <div class="form-group mb-3">
                <label for="form-label">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
            @if($user->foto)
                <p><img src="{{ asset('storage/foto_user/' . $user->foto) }}" alt="Foto" width="100"></p>
            @endif
            </div>

            <div class="form-group mb-3">
                <label for="name">Nama</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name ?? old('name') }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email ?? old('email') }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="nohp">Nomor HP</label>
                <input type="text" name="nohp" class="form-control" value="{{ $user->nohp ?? old('nohp') }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="address">Alamat</label>
                <textarea name="address" class="form-control" required>{{ $user->address ?? old('address') }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="role">Role</label>
                <select name="role" class="form-control" required>
                    <option value="admin" {{ (isset($user) && $user->role == 'admin') ? 'selected' : '' }}>Admin</option>
                    <option value="staff" {{ (isset($user) && $user->role == 'staff') ? 'selected' : '' }}>Staff</option>
                    <option value="student" {{ (isset($user) && $user->role == 'student') ? 'selected' : '' }}>Student</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" {{ isset($user) ? '' : 'required' }}>
                @if (isset($user))
                    <small>Kosongkan jika tidak ingin mengubah password.</small>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">{{ isset($user) ? 'Simpan Perubahan' : 'Simpan' }}</button>
        </form>
    </div>
</body>
</html>
@endsection

