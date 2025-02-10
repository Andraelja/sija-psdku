<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_dosen';
    protected $table = 'dosen';
    protected $fillable = ['nama', 'nidn', 'id_matkul'];

    // Relasi ke MataKuliah
    public function mataKuliah()
    {
        return $this->belongsTo(Matkul::class, 'id_matkul', 'id_matkul');
    }
}
 