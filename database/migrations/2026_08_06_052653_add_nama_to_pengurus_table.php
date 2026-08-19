<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengurus', function (Blueprint $table) {
            $table->string('nama')->nullable()->after('warga_id');
            $table->foreignId('warga_id')->nullable()->change();
        });

        DB::table('pengurus')
            ->leftJoin('warga', 'warga.id', '=', 'pengurus.warga_id')
            ->whereNull('pengurus.nama')
            ->update(['pengurus.nama' => DB::raw('warga.nama')]);
    }

    public function down(): void
    {
        Schema::table('pengurus', function (Blueprint $table) {
            $table->foreignId('warga_id')->nullable(false)->change();
            $table->dropColumn('nama');
        });
    }
};
