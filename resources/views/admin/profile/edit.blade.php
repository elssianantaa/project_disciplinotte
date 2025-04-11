@extends('layouts.admin') {{-- Sesuaikan dengan layout utama admin --}}

@section('content')
<div class="container" style="min-height: 80vh;">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow" style="border-radius: 15px;">
                <div class="card-body">
                    <h3 class="text-center mb-4">Edit Profile</h3>

                    {{-- Form Edit Profile --}}
                    <form action="{{ route('admin.profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Foto Profil --}}
                        <div class="text-center mb-3">
                            @if (Auth::user()->foto)
                            <img src="{{ asset('storage/foto_user/' . Auth::user()->foto) }}" 
                                 alt="Admin" 
                                 class="rounded-circle me-2" 
                                 style="width: 120px; height: 120px; object-fit: cover;">
                        @else
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                 style="width: 120px; height: 120px; font-size: 40px;">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                        
                        </div>

                        {{-- Input Fields --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="nohp" class="form-label">Nomor HP</label>
                            <input type="text" class="form-control" id="nohp" name="nohp" value="{{ old('nohp', $user->nohp) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required>{{ old('address', $user->address) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="photo" class="form-label">Foto Profil</label>
                            <input type="file" class="form-control" id="foto" name="foto">
                        </div>

                        {{-- Tombol Simpan --}}
                        <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
