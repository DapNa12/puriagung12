<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        User::where('role', 'ketua_karang_taruna')->update(['role' => 'warga']);
        User::where('role', 'ketua_pkk')->update(['role' => 'warga']);
        User::where('role', 'nonaktif')->update(['role' => 'warga']);

        // Set known sekretaris user if exists
        User::where('email', 'sekretaris@rwdusun.id')
            ->where('role', 'warga')
            ->update(['role' => 'sekretaris', 'is_active' => true]);
    }

    public function down(): void
    {
        // Cannot restore old roles as we don't know which warga were previously ketua_karang_taruna or ketua_pkk
    }
};
