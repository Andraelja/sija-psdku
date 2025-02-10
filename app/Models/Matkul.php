<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    use HasFactory;
    protected $table = 'mata_kuliah';
    protected $primaryKey = 'id_matkul';
    protected $fillable = ['nama_matkul', 'sks'];

    public function dosen()
    {
        return $this->hasMany(Dosen::class, 'id_matkul', 'id_matkul');
    }
}
