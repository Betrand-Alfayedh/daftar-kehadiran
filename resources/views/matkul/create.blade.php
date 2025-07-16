@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Mata Kuliah</h1>

    <form action="{{ route('matkul.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama_matkul" class="form-label">Nama Mata Kuliah</label>
            <input type="text" name="nama_matkul" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('matkul.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
