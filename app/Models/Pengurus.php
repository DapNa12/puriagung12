<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    protected $table = 'pengurus';

    protected $fillable = [
        'warga_id',
        'nama',
        'rt',
        'organisasi',
        'jabatan',
        'periode_mulai',
        'periode_selesai',
        'foto',
    ];
}
