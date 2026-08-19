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
            $table->string('rt', 3)->nullable()->after('warga_id');
        });

        DB::table('pengurus')
            ->leftJoin('warga', 'warga.id', '=', 'pengurus.warga_id')
            ->where('pengurus.jabatan', 'like', '%RT%')
            ->update(['pengurus.rt' => DB::raw('warga.rt')]);
    }

    public function down(): void
    {
        Schema::table('pengurus', function (Blueprint $table) {
            $table->dropColumn('rt');
        });
    }
};
