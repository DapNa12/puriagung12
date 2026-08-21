<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';

    protected $fillable = [
        'user_id',
        'nama_kegiatan',
        'deskripsi',
        'tanggal',
        'waktu',
        'tempat',
        'foto',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getWaktuFormattedAttribute(): ?string
    {
        return $this->waktu ? Carbon::parse($this->waktu)->format('H.i') : null;
    }
}
