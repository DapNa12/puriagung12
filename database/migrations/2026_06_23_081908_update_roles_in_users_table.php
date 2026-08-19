<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        User::where('role', 'pengurus')->where('name', 'Ketua RW')->update(['role' => 'ketua_rw']);
        User::where('name', 'Sekretaris RW')->update(['is_active' => false, 'role' => 'nonaktif']);
        User::where('name', 'Bendahara RW')->update(['is_active' => false, 'role' => 'nonaktif']);
    }

    public function down(): void
    {
        User::where('role', 'ketua_rw')->update(['role' => 'pengurus']);
        User::where('role', 'nonaktif')->update(['is_active' => true, 'role' => 'pengurus']);
    }
};
