<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    use HasFactory;
    protected $table = 'mata_kuliah';
    protected $primaryKey = 'id_matkul';
    protected $fillable = ['nama_matkul', 'sks', 'id_dosen', 'angkatan'];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen', 'id_dosen', 'angkatan');
    }

    public function jadwalKuliah()
    {
        return $this->hasMany(JadwalKuliah::class, 'id_matkul', 'id_matkul');
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'angkatan', 'angkatan');
    }

}
