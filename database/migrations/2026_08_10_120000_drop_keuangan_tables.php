<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('pengeluaran');
        Schema::dropIfExists('pemasukan');
    }

    public function down(): void
    {
        //
    }
};
