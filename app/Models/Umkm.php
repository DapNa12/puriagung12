<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Umkm extends Model
{
    protected $table = 'umkm';

    protected $fillable = [
        'user_id',
        'nama',
        'slug',
        'kategori',
        'deskripsi',
        'foto',
        'nama_pemilik',
        'alamat',
        'rt',
        'no_hp',
        'jam_operasional',
        'maps_link',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static array $kategoriList = [
        'Makanan & Minuman',
        'Jasa',
        'Retail/Toko',
        'Kerajinan',
        'Pertanian',
        'Kontraktor/Bangunan',
        'Kesehatan',
        'Pendidikan',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function boot(): void
    {
        parent::boot();

        static::creating(function (Umkm $umkm) {
            if (empty($umkm->slug)) {
                $umkm->slug = Str::slug($umkm->nama);
            }
        });

        static::updating(function (Umkm $umkm) {
            if ($umkm->isDirty('nama') && ! $umkm->isDirty('slug')) {
                $umkm->slug = Str::slug($umkm->nama);
            }
        });
    }
}
