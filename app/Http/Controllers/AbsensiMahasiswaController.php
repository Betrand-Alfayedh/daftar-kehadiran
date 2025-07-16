<?php

namespace App\Http\Controllers;

use App\Models\AbsensiMahasiswa;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\Dosen;
use App\Models\Matkul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiMahasiswaController extends Controller
{
    // Tampilkan daftar kelas
    public function index()
    {
        $kelasList = Kelas::orderBy('nama_kelas')->get();
        return view('absensi.index', compact('kelasList'));
    }

    // Form create absensi
public function create(Request $request)
{
    $kelasList = Kelas::all(); // Untuk dropdown pilihan kelas
    $mahasiswa = [];
    $kelas = null;
    $dosen = Dosen::all(); // Tambahkan untuk dropdown dosen
    $matkul = Matkul::all(); // Tambahkan untuk dropdown mata kuliah

    if ($request->filled('id_kelas') && is_numeric($request->id_kelas)) {
        $kelas = Kelas::find($request->id_kelas); // Gunakan find() agar tidak error jika null

        if ($kelas) {
            $mahasiswa = Mahasiswa::where('id_kelas', $request->id_kelas)->get();
        }
    }

    return view('absensi.create', compact('kelasList', 'kelas', 'mahasiswa', 'dosen', 'matkul'));
}



    // Simpan data absensi baru
   public function store(Request $request)
{
    $request->validate([
        'id_kelas' => 'required|exists:kelas,id_kelas',
        'id_dosen' => 'required|exists:dosen,id_dosen',
        'id_matkul' => 'required|exists:matkul,id_matkul',
        'tanggal' => 'required|date',
        'status' => 'required|array',
    ]);

    foreach ($request->status as $id_mahasiswa => $status) {
        AbsensiMahasiswa::create([
            'id_mahasiswa' => $id_mahasiswa,
            'id_kelas'     => $request->id_kelas,
            'id_dosen'     => $request->id_dosen,
            'id_matkul'    => $request->id_matkul,
            'tanggal'      => $request->tanggal,
            'status'       => $status,
            'keterangan'   => $request->keterangan[$id_mahasiswa] ?? null,
        ]);
    }

    return redirect()->route('absensi.preview', ['id_kelas' => $request->id_kelas])
    ->with('success', 'Absensi berhasil disimpan.');

}


// Tampilkan form edit absensi
public function edit($id)
{
    $absensi = AbsensiMahasiswa::with(['mahasiswa', 'kelas', 'dosen'])->findOrFail($id);
    $mahasiswa = Mahasiswa::all();
    $kelas = Kelas::all();
    $dosen = Dosen::all();
    $matkul = Matkul::all();

    return view('absensi.edit', compact('absensi', 'mahasiswa', 'kelas', 'dosen','matkul'));
}

// Simpan update absensi
public function update(Request $request, $id)
{
    // dd($request->all());

    $request->validate([
        'id_mahasiswa' => 'required|exists:mahasiswa,id_mahasiswa',
        'id_kelas'     => 'required|exists:kelas,id_kelas',
        'id_dosen'     => 'required|exists:dosen,id_dosen',
        'tanggal'      => 'required|date',
        'status'       => 'required|in:0,1,2,3', // 0: Hadir, 1: Izin, 2: Sakit, 3: Alpa
        'keterangan'   => 'nullable|string',
    ]);

    $absensi = AbsensiMahasiswa::findOrFail($id);
    $absensi->update([
        'id_mahasiswa' => $request->id_mahasiswa,
        'id_kelas'     => $request->id_kelas,
        'id_dosen'     => $request->id_dosen,
        'tanggal'      => $request->tanggal,
        'status'       => $request->status,
        'keterangan'   => $request->keterangan,
    ]);

    return redirect()->route('absensi.preview', $absensi->id_kelas)
        ->with('success', 'Absensi berhasil diperbarui.');
}


    // Hapus absensi
   public function destroy($id)
{
    $absensi = AbsensiMahasiswa::findOrFail($id);
    $id_kelas = $absensi->id_kelas; // Simpan sebelum hapus
    $absensi->delete();

    return redirect()->route('absensi.preview', ['id_kelas' => $id_kelas])
        ->with('success', 'Absensi berhasil dihapus.');
}


// AbsensiMahasiswaController.php

public function preview(Request $request, $id_kelas)
{
    $kelas = Kelas::findOrFail($id_kelas);
    $tanggal = $request->input('tanggal') ?? now()->toDateString();

    $mahasiswa = Mahasiswa::where('id_kelas', $id_kelas)->get();

    $absensiList = AbsensiMahasiswa::where('id_kelas', $id_kelas)
        ->whereDate('tanggal', $tanggal)
        ->with('dosen')
        ->get();

    return view('absensi.detail', compact('kelas', 'mahasiswa', 'absensiList', 'tanggal'));
}

}
