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
            $table->string('kategori', 50)->nullable()->after('foto');
        });

        DB::table('pengurus')->whereNotNull('rt')->update(['kategori' => 'rt']);
        DB::table('pengurus')->whereNotNull('organisasi')->update(['kategori' => 'organisasi']);
        DB::table('pengurus')->whereNull('kategori')->update(['kategori' => 'rw']);
    }

    public function down(): void
    {
        Schema::table('pengurus', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });
    }
};
