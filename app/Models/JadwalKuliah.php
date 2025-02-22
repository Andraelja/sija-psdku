<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKuliah extends Model
{
    use HasFactory;

    protected $table = 'jadwal_kuliah';
    protected $primaryKey = 'id_jadwal';
    protected $fillable = ['id_matkul', 'id_dosen', 'ruangan', 'angkatan', 'hari', 'jam_mulai', 'jam_selesai'];

    public function matkul()
    {
        return $this->belongsTo(Matkul::class, 'id_matkul', 'id_matkul');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen', 'id_dosen');
    }
}
