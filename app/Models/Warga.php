<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warga extends Model
{
    use SoftDeletes;

    protected $table = 'warga';

    protected $fillable = [
        'user_id',
        'nik',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'rt',
        'rw',
        'no_telepon',
        'pekerjaan',
        'status_perkawinan',
        'kewarganegaraan',
        'agama',
        'pendidikan',
        'golongan_darah',
        'no_rumah',
        'foto',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pengurus(): HasMany
    {
        return $this->hasMany(Pengurus::class);
    }
}
