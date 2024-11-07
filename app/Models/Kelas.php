<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'jumlah'
    ];

    public function dosen()
    {
        return $this->hasOne(Dosen::class);
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }
}
