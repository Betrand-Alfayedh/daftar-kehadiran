<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';
    protected $primaryKey = 'id_dosen';

    protected $fillable = [
        'nama',
        'nip',
    ];

    public function absensi()
    {
        return $this->hasMany(AbsensiMahasiswa::class, 'id_dosen', 'id_dosen');
    }
}
