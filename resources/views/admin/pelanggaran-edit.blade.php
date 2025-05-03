@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit Pelanggaran</h2>

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
            <li style="color:red;">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    
    <form action="{{ route('admin.pelanggaran.update', $pelanggarans->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Nama Pelanggaran:</label><br>
        <input type="text" name="nama_pelanggaran" value="{{ $pelanggarans->nama_pelanggaran }}"><br>
    
        <label>Point:</label><br>
        <input type="number" name="point" value="{{ $pelanggarans->point }}"><br>
    
        <label>Kategori:</label><br>
        <input type="text" name="Kategori" value="{{ $pelanggarans->Kategori }}"><br><br>
    
        <button type="submit">Update</button>
    </form>
    

</div>
{{-- 
<div>
    {{ $students->appends(request()->query())->links('pagination::bootstrap-5') }}
</div> --}}


@endsection
