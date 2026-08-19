<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatistikRw extends Model
{
    protected $table = 'statistik_rw';

    protected $fillable = [
        'jumlah_rumah_bangunan',
        'keterangan',
    ];
}
