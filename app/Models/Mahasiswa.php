<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_mahasiswa';
    protected $fillable = ['nama', 'nim', 'angkatan'];

    public function matkul()
    {
        return $this->belongsTo(Matkul::class, 'angkatan', 'angkatan');
    }
}
