<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        User::whereIn('email', [
            'karangtaruna@rwdusun.id',
            'pkk@rwdusun.id',
        ])->delete();
    }

    public function down(): void
    {
        // Cannot restore deleted users
    }
};
