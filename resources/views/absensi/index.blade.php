@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Daftar Kelas Absensi</h4>

 
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kelasList as $k)
            <tr>
                <td>{{ $k->nama_kelas }}</td>
                <td class="d-flex gap-2">
                    <a href="{{ route('absensi.preview', $k->id_kelas) }}" class="btn btn-sm btn-info" title="Preview">
                        <i class="fas fa-eye"></i>

                    </a>
                    <a href="{{ route('absensi.edit', $k->id_kelas) }}" class="btn btn-sm btn-warning">
                        <i class="fa fa-edit"></i>
                </a>

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="2" class="text-center">Tidak ada data kelas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
