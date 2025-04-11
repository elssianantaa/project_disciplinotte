@extends('layouts.admin') {{-- Ganti sesuai layout kamu --}}
@section('content')
<div class="content container mt-5">
    <h4 class="mb-4">Profil Admin</h4>

    <div class="card">
        <div class="card-body d-flex">
            @if($user->foto)
            <img src="{{ asset('storage/foto_user/' . $user->foto) }}" alt="Foto Profil" class="rounded-circle me-3" style="width: 100px; height: 100px; object-fit: cover;">
            @else
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" style="width: 100px; height: 100px; font-size: 40px;">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
            @endif

            <div>
                <p><strong>Nama:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>No HP:</strong> {{ $user->nohp }}</p>
                <p><strong>Alamat:</strong> {{ $user->address }}</p>
                <a href="{{ route('admin.profile.edit', $user->id) }}" class="btn btn-outline-primary btn-sm mt-2">Edit Profil</a>
            </div>
        </div>
    </div>
</div>
@endsection
