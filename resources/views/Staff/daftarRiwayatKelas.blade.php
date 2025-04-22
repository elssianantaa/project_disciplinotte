@extends('layouts.admin')

@section('content')
<div class="container">


        <a href="{{ route('form.naik.kelas') }}" class="btn btn-primary mb-3">
            Kenaikan Kelas Otomatis
        </a>

        

            {{-- Form Pencarian --}}
    {{-- <form action="{{ route('form.naik.kelas') }}" method="GET" class="mb-4">
        <div class="row g-2 align-items-end">
            <div class="col-md-4">
                <label for="kelas_id" class="form-label">Pilih Kelas:</label>
                <select name="kelas_id" id="kelas_id" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Semua Kelas --</option>
                    @foreach($kelasList as $kelas)
                        <option value="{{ $kelas->id }}" {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                            {{ $kelas->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            @if(request('kelas_id')) {{-- Munculkan hanya jika kelas dipilih --}}
            {{-- <div class="col-md-4">
                <label for="nama" class="form-label">Cari Nama Siswa:</label>
                <input type="text" name="nama" id="nama" value="{{ request('nama') }}" class="form-control" placeholder="Masukkan nama">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
            @endif
            <div class="col-md-2">
                <div class="form-label d-block">
                    Jumlah Siswa: <span class="fw-bold">{{ $totalSiswa }}</span>
                </div>
            </div>
        </div>
    </form> --}}

        <div class="table-container">
            {{-- @if($kelas->riwayatKelas->isEmpty())
            <p>Belum ada riwayat kenaikan kelas.</p> --}}
        {{-- @else --}}
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Periode Lama</th>
                    <th>Kelas Lama</th>
                    <th>Periode Baru</th>
                    <th>Kelas Baru</th>
                    <th>Tanggal Naik</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kelas as $riwayat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $riwayat->student->name }}</td>
                        <td>{{ $riwayat->periode_lama }}</td>
                        <td>{{ $riwayat->kelasLama->nama_kelas ?? '-' }}</td>
                        <td>{{ $riwayat->periode_baru }}</td>
                        <td>{{ $riwayat->kelas->nama_kelas ?? '-' }}</td>
                        <td>{{ $riwayat->created_at->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- @endif --}}
        </div>



    </main>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let sidebarLinks = document.querySelectorAll("#sidebar .nav-link");
            let currentPage = window.location.pathname.split("/").pop();

            sidebarLinks.forEach(link => {
                let linkPage = link.getAttribute("href");

                if (currentPage === linkPage) {
                    link.classList.add("active");
                }

                link.addEventListener("click", function () {
                    sidebarLinks.forEach(item => item.classList.remove("active"));
                    this.classList.add("active");
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @endsection

