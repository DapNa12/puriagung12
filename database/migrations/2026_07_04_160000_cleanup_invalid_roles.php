<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        User::where('role', 'nonaktif')->update(['role' => 'warga']);
        User::where('email', 'sekretaris@rwdusun.id')
            ->where('role', 'warga')
            ->update(['role' => 'sekretaris', 'is_active' => true]);
    }

    public function down(): void
    {
        // No reliable way to revert
    }
};
