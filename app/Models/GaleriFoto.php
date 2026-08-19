<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GaleriFoto extends Model
{
    protected $table = 'galeri_foto';

    protected $fillable = [
        'galeri_album_id',
        'judul',
        'foto',
    ];

    public function album(): BelongsTo
    {
        return $this->belongsTo(GaleriAlbum::class, 'galeri_album_id');
    }
}
