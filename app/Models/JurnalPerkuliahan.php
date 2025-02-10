<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalPerkuliahan extends Model
{
    use HasFactory;
    protected $table = 'jurnal_perkuliahan';
    protected $primaryKey = 'id_jurnal';
    protected $fillable = ['id_jadwal', 'id_dosen', 'materi', 'tanggal'];
    
    public function jadwalKuliah() {
        return $this->belongsTo(JadwalKuliah::class, 'id_jadwal');
    }
    
    public function dosen() {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }
}
