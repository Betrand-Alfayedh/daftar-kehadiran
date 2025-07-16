<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsensiMahasiswa extends Model
{
    protected $table = 'absensi_mahasiswa';
    protected $fillable = [
        'id_mahasiswa',
        'id_kelas',
        'id_dosen',
        'tanggal',
        'id_matkul',
        'status',
        'keterangan',
    ];

    protected $appends = ['status_keterangan'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen', 'id_dosen');
    }
     public function matkul()
    {
        return $this->belongsTo(Matkul::class, 'id_matkul', 'id_matkul');
    }


    public function getStatusKeteranganAttribute()
    {
        return match ($this->status) {
            0 => 'Hadir',
            1 => 'Sakit',
            2 => 'Izin',
            3 => 'Alfa',
            default => 'Tidak Diketahui',
        };
    }
}
