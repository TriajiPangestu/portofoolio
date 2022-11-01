<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kontak extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_siswa',
        'id_jenis',
        'deskripsi'
    ];
    protected $table = 'kontak';

    public function siswa() {
        return $this->belongsTo('App\Models\siswa', 'id');
    }
    public function jenis_kontak() {
        return $this->hasOne('App\Models\jenis_kontak', 'id');
    }
}
