<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    use HasFactory;
    protected $fillable = [
        'nisn',
        'nama',
        'alamat',
        'jk',
        'foto',
        'about',
        'email'
    ];
    protected $table = 'siswa';

    public function kontak () {
        return $this->belongsToMany('App\Models\jenis_kontak', 'id_siswa')->withpivot('deskripsi');
    }
    public function projek() {
        return $this->hasMany('App\Models\projek', 'id_siswa');
    }
}
