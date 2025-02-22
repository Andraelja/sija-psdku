<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    
    protected $table = 'absensi';
    protected $primaryKey = 'id_absensi';
    protected $fillable = ['id_mahasiswa', 'id_matkul', 'tanggal', 'waktu', 'status'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    public function matkul()
    {
        return $this->belongsTo(Matkul::class, 'id_matkul', 'id_matkul');
    }

    public function scopeRekapAbsensi($query, $id_matkul)
    {
        return $query->selectRaw("
            id_matkul,
            COUNT(CASE WHEN status = 'Hadir' THEN 1 END) as hadir,
            COUNT(CASE WHEN status = 'Izin' THEN 1 END) as izin,
            COUNT(CASE WHEN status = 'Sakit' THEN 1 END) as sakit,
            COUNT(CASE WHEN status = 'Alfa' THEN 1 END) as alfa
        ")->where('id_matkul', $id_matkul)->groupBy('id_matkul')->first();
    }
}
