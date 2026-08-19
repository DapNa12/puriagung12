<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        User::updateOrCreate(
            ['email' => 'karangtaruna@rwdusun.id'],
            [
                'name' => 'Ketua Karang Taruna',
                'password' => Hash::make('password'),
                'role' => 'ketua_karang_taruna',
                'is_active' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'pkk@rwdusun.id'],
            [
                'name' => 'Ketua PKK',
                'password' => Hash::make('password'),
                'role' => 'ketua_pkk',
                'is_active' => true,
            ]
        );
    }

    public function down(): void
    {
        User::whereIn('email', ['karangtaruna@rwdusun.id', 'pkk@rwdusun.id'])->delete();
    }
};
