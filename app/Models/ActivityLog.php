<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Request;

class ActivityLog extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
        'created_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function log(
        string $action,
        Model $model,
        string $description,
        ?array $oldValues = null,
        ?array $newValues = null,
    ): static {
        return static::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'model_type' => class_basename($model),
            'model_id' => $model->getKey(),
            'model_name' => $description,
            'description' => $action === 'create'
                ? 'Menambahkan '.class_basename($model).': '.$description
                : ($action === 'update'
                    ? 'Memperbarui '.class_basename($model).': '.$description
                    : 'Menghapus '.class_basename($model).': '.$description),
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
            'created_at' => now(),
        ]);
    }

    public function getActionLabelAttribute(): string
    {
        return match ($this->action) {
            'create' => 'Dibuat',
            'update' => 'Diperbarui',
            'delete' => 'Dihapus',
            default => $this->action,
        };
    }
}
