<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatistikRwDetail extends Model
{
    protected $table = 'statistik_rw_detail';

    protected $fillable = [
        'rt',
        'laki',
        'perempuan',
        'balita',
        'anak',
        'remaja',
        'dewasa',
        'lansia',
        'islam',
        'kristen',
        'katolik',
        'budha',
        'hindu',
        'lainnya',
        'belum_sekolah',
        'sd',
        'smp',
        'sma',
        'd1',
        'd2',
        'd3',
        's1',
        's2',
        's3',
        'goldar_a',
        'goldar_b',
        'goldar_ab',
        'goldar_o',
    ];

    public function getTotalAttribute(): int
    {
        return $this->laki + $this->perempuan;
    }
}
