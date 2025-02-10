<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $table = 'absensi';
    protected $primaryKey = 'id_absensi';
    protected $fillable = ['id_jadwal', 'id_mahasiswa', 'status', 'waktu'];
    
    public function jadwalKuliah() {
        return $this->belongsTo(JadwalKuliah::class, 'id_jadwal');
    }
    
    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }
}
