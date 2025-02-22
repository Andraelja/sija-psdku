<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_dosen';
    protected $table = 'dosen';
    protected $fillable = ['nama', 'nidn', 'matkul', 'email', 'password'];

    public function matkul()
    {
        return $this->hasMany(Matkul::class, 'id_dosen', 'id_dosen');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'nidn', 'username');
    }

    public function userLogin()
    {
        return $this->belongsTo(User::class, 'id');
    }



}
