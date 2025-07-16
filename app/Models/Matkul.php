<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    protected $table = 'matkul';
    protected $primaryKey = 'id_matkul';

    protected $fillable = [
        'nama_matkul',
    ];
    
    // Jika nanti Anda ingin relasi dengan absensi, bisa tambahkan di sini
}
