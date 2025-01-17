<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestEdit extends Model
{
    use HasFactory;

    protected $table = 'request';

    protected $fillable = [
        'kelas_id', 
        'mahasiswa_id', 
        'keterangan'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
