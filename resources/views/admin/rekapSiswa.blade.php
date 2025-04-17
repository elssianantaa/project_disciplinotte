@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Rekap Siswa</h2>

    {{-- Form Pencarian --}}
    <form action="{{ route('rekap.siswa') }}" method="GET" class="mb-4">
        <div class="row g-2 align-items-end">

            <div class="col-md-3">
                <label for="periode" class="form-label">Pilih Periode:</label>
                <select name="periode" id="periode" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Semua Periode --</option>
                    @foreach($periodeList as $periode)
                    <option value="{{ $periode }}" {{ request('periode') == $periode ? 'selected' : '' }}>
                        {{ $periode }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
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
            <div class="col-md-3">
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
    </form>




    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

   <div class="table-responsive">
    <table class="table table-bordered align-middle">
        <thead>
            <tr class="text-center">
                <th>NO</th>
                <th>Foto</th>
                <th>NISN</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Jenis Kelamin</th>
                <th>Status</th>
                <th>Point Pelanggaran</th>
                {{-- <th>Aksi</th> --}}
            </tr>
        </thead>
        <tbody>
            @forelse($students as $siswa)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center">
                    <img src="{{ asset('storage/foto_siswa/'.$siswa->foto) }}" alt="Foto Siswa" class="foto-siswa">
                </td>
                <td>{{ $siswa->nisn }}</td>

                <td>
                    {{ $siswa->name }}
                    @php
                        $riwayatKelasLama = $siswa->riwayatkelas->firstWhere('periode_lama', request('periode'));
                        $riwayatKelasBaru = $siswa->riwayatkelas->firstWhere('periode_baru', request('periode'));
                    @endphp

                    @if ($riwayatKelasLama)
                        <br>Periode Lama ({{ $riwayatKelasLama->periode_lama }}): {{ $riwayatKelasLama->kelasLama?->nama_kelas ?? 'Kelas tidak ditemukan' }}
                    @endif

                    @if ($riwayatKelasBaru)
                        <br>Periode Baru ({{ $riwayatKelasBaru->periode_baru }}): {{ $riwayatKelasBaru->kelas?->nama_kelas ?? 'Kelas tidak ditemukan' }}
                    @endif
                </td>


                {{-- Menampilkan kelas berdasarkan periode --}}
                <td>
                    @php
                        // Cek apakah periode yang diminta adalah periode lama atau baru
                        $riwayatKelas = $siswa->riwayatkelas->first(function($item) use ($request) {
                            return $item->periode_lama == $request->periode || $item->periode_baru == $request->periode;
                        });

                    @endphp
                    @if($riwayatKelas)
                        {{-- Cek apakah ada kelas baru atau lama --}}
                        @if($request->periode == $riwayatKelas->periode_baru && $riwayatKelas->kelas)
                            {{ $riwayatKelas->kelas->nama_kelas ?? 'Tidak Diketahui' }}
                        @elseif($request->periode == $riwayatKelas->periode_lama && $riwayatKelas->kelasLama)
                            {{ $riwayatKelas->kelasLama->nama_kelas ?? 'Tidak Diketahui' }}
                        @else
                            Kelas tidak ditemukan untuk periode ini
                        @endif
                    @else
                        {{-- Menampilkan kelas default sebelum filter diterapkan --}}
                        {{$siswa->kelas->nama_kelas}}

                    @endif
                </td>





                <td>{{ $siswa->jenis_kelamin }}</td>
                <td>{{ ucfirst($siswa->status) }}</td>
                <td>
                    {{ $siswa->catatanpelanggarans->sum(fn($cp) => $cp->pelanggaran->point ?? 0) }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center">Data tidak ditemukan.</td>
            </tr>
            @endforelse
        </tbody>

    </table>
</div>

@endsection
