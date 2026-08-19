<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengurus extends Model
{
    protected $table = 'pengurus';

    protected $fillable = [
        'warga_id',
        'nama',
        'rt',
        'jabatan',
        'periode_mulai',
        'periode_selesai',
        'foto',
    ];

    public function warga(): BelongsTo
    {
        return $this->belongsTo(Warga::class);
    }
}
