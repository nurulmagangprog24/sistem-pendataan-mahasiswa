<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';

    protected $fillable = [
        'user_id', 
        'kelas_id', 
        'kode_dosen', 
        'nip', 
        'name'
    ];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::deleting(function ($dosen) {
    //         // Hapus user yang terkait dengan dosen
    //         if ($dosen->user) {
    //             $dosen->user->delete();
    //         }
    //     });
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
        
}
