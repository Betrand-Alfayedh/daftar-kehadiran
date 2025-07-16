@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Form Absensi Mahasiswa</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Pilih Kelas --}}
    <form method="GET" action="{{ route('absensi.create') }}" class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <label for="id_kelas" class="form-label">Pilih Kelas</label>
                <select name="id_kelas" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Pilih --</option>
                    @foreach($kelasList as $k)
                        <option value="{{ $k->id_kelas }}" {{ request('id_kelas') == $k->id_kelas ? 'selected' : '' }}>
                            {{ $k->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    {{-- Form Absensi --}}
    @if(request('id_kelas') && count($mahasiswa) > 0)
    <form method="POST" action="{{ route('absensi.store') }}">
        @csrf

        @if($kelas)
            <input type="hidden" name="id_kelas" value="{{ $kelas->id_kelas }}">
        @endif

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>

            <div class="col-md-4">
                <label for="id_dosen" class="form-label">Pilih Dosen</label>
                <select name="id_dosen" class="form-select" required>
                    <option value="">-- Pilih Dosen --</option>
                    @foreach($dosen as $d)
                        <option value="{{ $d->id_dosen }}">{{ $d->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="id_matkul" class="form-label">Pilih Mata Kuliah</label>
                <select name="id_matkul" class="form-select" required>
                    <option value="">-- Pilih Mata Kuliah --</option>
                    @foreach($matkul as $m)
                        <option value="{{ $m->id_matkul }}">{{ $m->nama_matkul }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Mahasiswa</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mahasiswa as $m)
                <tr>
                    <td>{{ $m->nama }}</td>
                    <td>
                        <select name="status[{{ $m->id_mahasiswa }}]" class="form-select" required>
                            <option value="0">Hadir</option>
                            <option value="1">Sakit</option>
                            <option value="2">Izin</option>
                            <option value="3">Alfa</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="keterangan[{{ $m->id_mahasiswa }}]" class="form-control">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Simpan Absensi</button>
    </form>
    @elseif(request('id_kelas'))
        <div class="alert alert-warning">Tidak ada mahasiswa di kelas ini.</div>
    @endif
</div>
@endsection
