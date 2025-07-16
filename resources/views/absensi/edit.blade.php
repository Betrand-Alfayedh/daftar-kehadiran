@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Edit Absensi Mahasiswa</h4>

    <form action="{{ route('absensi.update', $absensi->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Hidden input untuk kebutuhan update --}}
        <input type="hidden" name="id_mahasiswa" value="{{ $absensi->id_mahasiswa }}">
        <input type="hidden" name="id_kelas" value="{{ $absensi->id_kelas }}">

        <div class="mb-3">
            <label class="form-label">Nama Mahasiswa</label>
            <input type="text" class="form-control" value="{{ $absensi->mahasiswa->nama }}" disabled>
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $absensi->tanggal }}">
        </div>

        <div class="mb-3">
            <label for="id_dosen" class="form-label">Dosen</label>
            <select name="id_dosen" id="id_dosen" class="form-select">
                @foreach($dosen as $d)
                    <option value="{{ $d->id_dosen }}" {{ $absensi->id_dosen == $d->id_dosen ? 'selected' : '' }}>
                        {{ $d->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        @if(isset($matkul))
        <div class="mb-3">
            <label for="id_matkul" class="form-label">Mata Kuliah</label>
            <select name="id_matkul" id="id_matkul" class="form-select">
                @foreach($matkul as $m)
                    <option value="{{ $m->id_matkul }}" {{ $absensi->id_matkul == $m->id_matkul ? 'selected' : '' }}>
                        {{ $m->nama_matkul }}
                    </option>
                @endforeach
            </select>
        </div>
        @endif

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="0" {{ $absensi->status == 0 ? 'selected' : '' }}>Hadir</option>
                <option value="1" {{ $absensi->status == 1 ? 'selected' : '' }}>Izin</option>
                <option value="2" {{ $absensi->status == 2 ? 'selected' : '' }}>Sakit</option>
                <option value="3" {{ $absensi->status == 3 ? 'selected' : '' }}>Alpa</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan Tambahan</label>
            <textarea name="keterangan" id="keterangan" class="form-control">{{ $absensi->keterangan }}</textarea>
        </div>

        <div class="d-flex justify-content-start gap-2">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('absensi.preview', $absensi->id_kelas) }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
