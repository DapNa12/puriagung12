<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GaleriAlbum extends Model
{
    protected $table = 'galeri_album';

    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'tanggal',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function fotos(): HasMany
    {
        return $this->hasMany(GaleriFoto::class, 'galeri_album_id');
    }

    public function getCoverAttribute(): ?string
    {
        return $this->fotos->first()?->foto;
    }

    public function getCoverFotoAttribute(): ?GaleriFoto
    {
        return $this->fotos->first();
    }
}
