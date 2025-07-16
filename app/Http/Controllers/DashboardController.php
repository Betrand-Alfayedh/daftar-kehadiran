<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\Matkul;
use App\Models\AbsensiMahasiswa;

class DashboardController extends Controller
{
    public function index()
    {
        $totalDosen = Dosen::count();
        $totalMahasiswa = Mahasiswa::count();
        $totalKelas = Kelas::count();
        $totalMatkul = Matkul::count();
        $absensiTerbaru = AbsensiMahasiswa::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalDosen', 
            'totalMahasiswa', 
            'totalKelas', 
            'totalMatkul', 
            'absensiTerbaru'
        ));
    }
}
